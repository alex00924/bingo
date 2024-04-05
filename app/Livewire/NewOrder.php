<?php

namespace App\Livewire;

use Livewire\Component;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\models\Orders;
use App\Models\OrderDetails;
use App\Models\BingoCards;

class NewOrder extends Component
{
    public string $name = '';
    public string $city = '';
    public string $phone = '';
    public int $quantity = 1;
    public int $processStatus = 1;
    public string $qr_code = '';
    public string $qr_code_base64 = '';
    public string $ticket_url = '';
    public string $payment_request_id = '';

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'], //, 'regex:/([0-9]{9})[0-9]{9}/'
            'city' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'gt:0']
        ];
    }

    public function mount() {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->city = auth()->user()->city;
            $this->phone = auth()->user()->phone;
        }
    }

    public function nextStep() {
        if ($this->processStatus == 1) {
            $this->validate();


            $user = User::where('phone', $this->phone)->first();
            if (empty($user)) {
                $user = User::create([
                    'name' => $this->name,
                    'phone' => $this->phone,
                    'email' => $this->phone,
                    'password' => Hash::make('123456789'),
                    'city' => $this->city
                ]);

                event(new Registered($user));
            }

            $user->name = $this->name;
            $user->city = $this->city;
            $user->save();

            Auth::login($user);
        }
        $this->processStatus += 1;
        if ($this->processStatus == 3) {
            $this->createPaymentRequest();
        }
    }

    private function createPaymentRequest_New() {
        // Step 2: Set production or sandbox access token
        MercadoPagoConfig::setAccessToken(env('PIX_ACCESS_TOKEN'));
        // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
        // In case you want to test in your local machine first, set runtime enviroment to LOCAL
        MercadoPagoConfig::setRuntimeEnviroment(env('PIX_RUN_TIME'));

        // Step 3: Initialize the API client
        $client = new PaymentClient();

        try {
            $name_parts = explode(" ", $this->name);
            $lastname = array_pop($name_parts);
            $firstname = implode(" ", $name_parts);
            
            $expireDate = date("Y-m-d\TH:i:s.000P", strtotime("+30 minutes"));
            
            // $area_code = 
            // Step 4: Create the request array
            $requestData = [
                "transaction_amount" => $this->quantity * 10,
                // "token" => "YOUR_CARD_TOKEN",
                "description" => "Pagamento de Prêmios D'BILHAR",
                "payment_method_id" => "pix",
                "date_of_expiration" => $expireDate,
                "payer" => [
                    "email" => "contato@chapadahost.com.br",
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "phone" => [
                        "area_code" => 11,
                        "number" => "987654321"
                    ],
                    "address" => [
                        "city" => $this->city
                    ]
                ]
            ];

            // Step 5: Create the request options, setting X-Idempotency-Key
            $request_options = new RequestOptions();
            $idempotency_key = Str::random(10);
            
            $request_options->setCustomHeaders(["X-Idempotency-Key: " . $idempotency_key]);

            // Step 6: Make the request
            $payment = $client->create($requestData, $request_options);
            $this->payment_request_id = $payment->id;
            $this->qr_code_base64 = $payment->point_of_interaction->transaction_data->qr_code_base64;
            $this->qr_code = $payment->point_of_interaction->transaction_data->qr_code;
            $this->ticket_url = $payment->point_of_interaction->transaction_data->ticket_url;
        // Step 7: Handle exceptions
        } catch (MPApiException $e) {
            $this->notify(json_encode($e->getApiResponse()->getContent()), "Error", "error");
        } catch (\Exception $e) {
            $this->notify($e->getMessage(), "Error", "error");
        }
    }

    private function createPaymentRequest() {
        // Step 2: Set production or sandbox access token
        \MercadoPago\SDK::setAccessToken(env('PIX_ACCESS_TOKEN'));
        // MercadoPagoConfig::setAccessToken(env('PIX_ACCESS_TOKEN'));
        // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
        // In case you want to test in your local machine first, set runtime enviroment to LOCAL
        // \MercadoPago\SDK::setRuntimeEnviroment(env('PIX_RUN_TIME'));

        // Step 3: Initialize the API client
        $payment = new \MercadoPago\Payment();//new PaymentClient();

        try {
            $name_parts = explode(" ", $this->name);
            $lastname = array_pop($name_parts);
            $firstname = implode(" ", $name_parts);
            
            $expireDate = date("Y-m-d\TH:i:s.000P", strtotime("+30 minutes"));
            $payment->transaction_amount = $this->quantity * 10;
            $payment->description = "Pagamento de Prêmios D'BILHAR";
            $payment->payment_method_id = "pix";
            $payment->date_of_expiration = $expireDate;
            $payment->payer = [
                "email" => "contato@chapadahost.com.br",
                "first_name" => $firstname,
                "last_name" => $lastname,
                "phone" => [
                    "area_code" => 11,
                    "number" => $this->phone
                ],
                "address" => [
                    "city" => $this->city
                ]
            ];

            $payment->save();

            $this->payment_request_id = $payment->id;
            $this->qr_code_base64 = $payment->point_of_interaction->transaction_data->qr_code_base64;
            $this->qr_code = $payment->point_of_interaction->transaction_data->qr_code;
            $this->ticket_url = $payment->point_of_interaction->transaction_data->ticket_url;
        // Step 7: Handle exceptions
        } catch (\Exception $e) {
            $this->notify($e->getMessage(), "Error", "error");
        }
    }

    public function changeQuantity($amount = 1) {
        $this->quantity += $amount;
        $this->quantity = max(1, $this->quantity);
    }

    public function processOrder() {
        $user_id = auth()->user()->id;
        // Create Orders
        $order = Orders::create([
            'user_id' => $user_id,
            'quantity' => $this->quantity,
            'price' => $this->quantity * 10,
            'payment_status' => 0,
            'payment_id' => $this->payment_request_id,
            'qr_code' => $this->qr_code,
            'qr_code_base64' => $this->qr_code_base64,
            'ticket_url' => $this->ticket_url
        ]);

        // Fetch random rows from BingoCard
        $bingoCards = BingoCards::inRandomOrder()->limit($this->quantity)->get();
        foreach($bingoCards as $bingoCard) {
            OrderDetails::create([
                'order_id' => $order->id,
                'bingo_card_id' => $bingoCard->id,
                'user_id' => $user_id
            ]);
        }
        
        // redirect to order list page
        $this->redirectRoute('order.list');
    }

    public function render()
    {
        return view('livewire.new-order');
    }
}
