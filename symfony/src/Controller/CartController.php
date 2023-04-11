<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItems;
use App\Entity\Product;
use App\Form\UserType;
use App\Repository\ProductRepository;
use App\Repository\ReduceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\Length;

class CartController extends AbstractController
{
    /**
     * Display cart
     *
     * @param SessionInterface $session
     * @param ProductRepository $productRepository
     * @return Response
     */
    #[Route('/panier', name: 'cart.index')]
    public function index(
        SessionInterface $session,
        ProductRepository $productRepository,
        Request $request,
        ReduceRepository $reduceRepo
    ): Response {
        // Get cart from session
        $cart = $session->get('panier', []);
        $dataReduce = $session->get('reduce', []);
        if (empty($cart)) {
            $session->set('reduce', []);
        }
        //form for reduce
        $defaultReduce = ['code' => ''];
        $reduceForm = $this->createFormBuilder($defaultReduce)
            ->add('code', TextType::class, [
                'constraints' => new Length(['min' => 3]),
                'attr' => ['placeholder' => 'Code de réduction']
            ])
            ->getForm();
        $reduceForm->handleRequest($request);

        $dataCart = [];
        $total = 0;
        $productTotal = 0;
        foreach ($cart as $product) {
            $productData = $productRepository->find($product['id']);
            $dataCart[] = [
                "product" => $productData,
                "color" => $product['color'],
                "quantity" => $product['quantity'],
            ];
            $total += ($productData->getPriceHt() * 1.2) * $product['quantity'];
            $productTotal += $product['quantity'];
        }

        // need to $total for the reduction
        if ($reduceForm->isSubmitted() && $reduceForm->isValid()) {
            $codeReduce = $reduceForm->getData();
            $reduce = $reduceRepo->findOneby(['code' => $codeReduce['code']]);
            if ($reduce) {
                if (new \DateTime('now') < $reduce->getDateEnd() && $reduce->isActive() && $reduce->getMinPrice() < $total) {
                    $dataReduce = [
                        "code" => $codeReduce['code'],
                        "type" => $reduce->getType(),
                        "value" => $reduce->getValue(),
                    ];
                    $session->set('reduce', $dataReduce);
                    $this->addFlash('success', 'Code promo ajouté');
                } else {
                    $this->addFlash('warning', 'Code promo expiré ou somme insuffisante');
                }
            } else {
                $session->set('reduce', []);
                $this->addFlash('danger', 'Code promo inconnu');
                return $this->redirectToRoute("cart.index");
            }
        }

        $totalReduce = 0;
        if ($dataReduce) {
            if ($dataReduce['type'] == '€') {
                $totalReduce = $total - $dataReduce['value'] * 100;
            }
            if ($dataReduce['type'] == '%') {
                $totalReduce = $total - ($total * ($dataReduce['value'] / 100));
            }
        }

        return $this->render('cart/index.html.twig', compact("dataCart", "total", "productTotal", "reduceForm", "dataReduce", "totalReduce"));
    }

    #[Route('/panier/livraison', name: 'cart.delivery')]
    #[IsGranted('ROLE_USER')]
    public function delivery(SessionInterface $session, ProductRepository $productRepository, Request $request, ReduceRepository $reduceRepo, EntityManagerInterface $manager): Response
    {
        // Get cart from session
        $cart = $session->get('panier', []);
        $dataReduce = $session->get('reduce', []);
        if (empty($cart)) {
            return $this->redirectToRoute('cart.index');
        }
        $dataCart = [];
        $total = 0;
        $productTotal = 0;
        foreach ($cart as $product) {
            $productData = $productRepository->find($product['id']);
            $dataCart[] = [
                "product" => $productData,
                "color" => $product['color'],
                "quantity" => $product['quantity'],
            ];
            $total += ($productData->getPriceHt() * 1.2) * $product['quantity'];
            $productTotal += $product['quantity'];
        }
        $totalReduce = 0;
        if ($dataReduce) {
            if ($dataReduce['type'] == '€') {
                $totalReduce = $total - $dataReduce['value'] * 100;
            }
            if ($dataReduce['type'] == '%') {
                $totalReduce = $total - ($total * ($dataReduce['value'] / 100));
            }
        }

        $deliveryForm = $this->createForm(UserType::class, $this->getUser(), ['options' => 'delivery']);
        $deliveryForm->handleRequest($request);

        if ($deliveryForm->isSubmitted() && $deliveryForm->isValid()) {
            $manager->persist($this->getUser());
            $manager->flush();

            return $this->redirectToRoute('cart.payment');
        }
        return $this->render('cart/delivery.html.twig', compact("dataCart", "total", "productTotal", "dataReduce", "totalReduce", "deliveryForm"));
    }

    #[Route('/panier/paiement', name: 'cart.payment')]
    #[IsGranted('ROLE_USER')]
    public function payment(SessionInterface $session, ProductRepository $productRepository, EntityManagerInterface $manager): Response
    {
        // Get cart from session
        $cart = $session->get('panier', []);
        $dataReduce = $session->get('reduce', []);
        if (empty($cart)) {
            return $this->redirectToRoute('cart.index');
        }

        $stripeCart = [];
        $order = new Order();
        $total = 0;
        foreach ($cart as $product) {
            $productData = $productRepository->find($product['id']);
            $stripeCart[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $productData->getBrand() . ' - ' . $productData->getModel() . ' - ' . $product['color'],
                    ],
                    'unit_amount' => $productData->getPriceHt() * 1.2,
                ],
                'quantity' => $product['quantity'],
            ];

            $orderItem = new OrderItems;
            $orderItem->setProduct($productData)
                ->setOrder($order)
                ->setQuantity($product['quantity'])
                ->setTotal(($productData->getPriceHt() * 1.2) * $product['quantity'])
                ->setColor($product['color']);

            $manager->persist($orderItem);
            $total += $orderItem->getTotal();
        }

        $stripe = new \Stripe\StripeClient('sk_test_51MtoxTH83TDU5LYyGV0f2MmiV6wILYSo7lqL68BYwkELL08yVIRCsUN5HlD3WGJLoxWVkJvoyXWHVwGIVapf6M7P00MQ04ZY2P');


        $stripeReduce = [];
        if ($dataReduce) {
            try {
                $stripe->coupons->retrieve($dataReduce['code']);
            } catch (\Exception $e) {
                if ($dataReduce['type'] == '€') {
                    $stripe->coupons->create(['amount_off' => $dataReduce['value'] * 100, 'currency' => 'eur', 'duration' => 'forever', 'id' => $dataReduce['code'], 'name' => $dataReduce['code']]);
                }
                if ($dataReduce['type'] == '%') {
                    $stripe->coupons->create(['percent_off' => $dataReduce['value'], 'duration' => 'forever', 'id' => $dataReduce['code'], 'name' => $dataReduce['code']]);
                }
            }
            if ($dataReduce['type'] == '€') {
                $totalWithReduce = $total - $dataReduce['value'];
                $totalReduce = $dataReduce['value'];
            }
            if ($dataReduce['type'] == '%') {
                $totalWithReduce = $total - ($total * ($dataReduce['value'] / 100));
                $totalReduce = $total * ($dataReduce['value'] / 100);
            }

            $stripeReduce = [
                'coupon' => $dataReduce['code']
            ];
        }

        $totalWithReduce = $total;
        $totalReduce = 0;
        $order->setUser($this->getUser())
            ->setStatus('Annulé')
            ->setPayment('Non Payé')
            ->setTotal($totalWithReduce)
            ->setReduce($totalReduce);

        $manager->persist($order);
        $manager->flush();

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        Stripe::setApiKey('sk_test_51MtoxTH83TDU5LYyGV0f2MmiV6wILYSo7lqL68BYwkELL08yVIRCsUN5HlD3WGJLoxWVkJvoyXWHVwGIVapf6M7P00MQ04ZY2P');
        $checkout_session = \Stripe\Checkout\Session::create([
            'customer_email' => $user->getEmail(),
            'line_items' => [$stripeCart],
            'discounts' => [$stripeReduce],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('cart.success', ['id' => $order->getId()], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('cart.failed', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        $order->setIdStripe($checkout_session->id);
        $manager->persist($order);
        $manager->flush();

        return $this->redirect($checkout_session->url, 303);
    }


    #[Route('/panier/paiement/succes/{id}', name: 'cart.success')]
    #[IsGranted('ROLE_USER')]
    public function successUrl(Order $order, SessionInterface $session, EntityManagerInterface $manager)
    {
        $cart = $session->get('panier', []);
        if (empty($cart)) {
            return $this->redirectToRoute('cart.index');
        }


        $stripe = new \Stripe\StripeClient('sk_test_51MtoxTH83TDU5LYyGV0f2MmiV6wILYSo7lqL68BYwkELL08yVIRCsUN5HlD3WGJLoxWVkJvoyXWHVwGIVapf6M7P00MQ04ZY2P');

        if ($stripe->checkout->sessions->retrieve($order->getIdStripe())->payment_status == 'paid') {
            $order->setStatus('En cours')
                ->setPayment('Payé');
            foreach ($order->getOrderItems() as $product) {
                $product->getProduct()->setStock($product->getProduct()->getStock() - $product->getQuantity());
            }

            $manager->persist($order);
            $manager->flush();

            // delete cart and reduce
            $session->set('panier', []);
            $session->set('reduce', []);
            return $this->render('cart/success.html.twig');
        } else {
            return $this->redirectToRoute('cart.index');
        }
    }

    #[Route('/panier/paiement/echec', name: 'cart.failed')]
    #[IsGranted('ROLE_USER')]
    public function failedUrl()
    {
        return $this->render('cart/failed.html.twig');
    }


    /**
     * Add item to cart
     *
     * @param Int $id
     * @param SessionInterface $session
     * @param Request $request
     * @return Response
     */
    #[Route('/cart/add/{id}', name: 'cart.add')]
    public function add(Product $product, SessionInterface $session, Request $request): Response
    {

        // Get cart from session
        $cart = $session->get('panier', []);
        $color = $request->get('color');
        $handleAdd = 0;

        // if cart is empty = add product
        if ($product->getStock() < 1) {
            $this->addFlash('warning', 'Le produit n\'est plus en stock');
        } else {
            if (empty($cart)) {
                $cart[] = [
                    'id' => $product->getId(),
                    'color' => $color,
                    'quantity' => 1
                ];
                //if cart isn't empty
            } else {
                foreach ($cart as $index => $prod) {
                    //if product already exist in cart
                    if ($prod['id'] == $product->getId() && $product->getStock() < $prod['quantity'] + 1) {
                        $this->addFlash('warning', 'Le produit n\'est plus en stock');
                        $handleAdd = 1;
                    } else {
                        if ($prod['id'] == $product->getId() && $prod['color'] == $color) {
                            $cart[$index]['quantity'] = $prod['quantity'] + 1;
                            $handleAdd = 1;
                        }
                    }
                }
                // if product doesn't exist in cart
                if ($handleAdd == 0) {
                    $cart[] = [
                        'id' => $product->getId(),
                        'color' => $color,
                        'quantity' => 1
                    ];
                }
            }
        }
        // Save cart on session
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }

    /**
     * Remove one item from cart
     *
     * @param Int $id
     * @param String $color
     * @param SessionInterface $session
     * @return Response
     */
    #[Route('/cart/remove/{id}/{color}', name: 'cart.remove')]
    public function remove(Int $id, String $color, SessionInterface $session): Response
    {

        // Get cart from session
        $cart = $session->get('panier', []);

        foreach ($cart as $index => $product) {
            if ($product['id'] == $id && $product['color'] == $color) {
                if ($product['quantity'] > 1) {
                    $cart[$index]['quantity'] = $product['quantity'] - 1;
                } else {
                    unset($cart[$index]);
                }
            }
        }

        // Save cart on session
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }

    /**
     * delete one item from cart
     *
     * @param Int $id
     * @param String $color
     * @param SessionInterface $session
     * @return Response
     */
    #[Route('/cart/delete/{id}/{color}', name: 'cart.delete')]
    public function delete(Int $id, String $color, SessionInterface $session): Response
    {
        // Get cart from session
        $cart = $session->get('panier', []);

        foreach ($cart as $index => $product) {
            if ($product['id'] == $id && $product['color'] == $color) {
                unset($cart[$index]);
            }
        }

        // Save cart on session
        $session->set('panier', $cart);

        return $this->redirectToRoute("cart.index");
    }
}
