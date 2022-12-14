<?php namespace LibUser\Userapi\Http\Controllers;

    use Illuminate\Support\Facades\Mail;
    use RainLab\User\Facades\Auth;
    use LibUser\Userapi\Http\Resources\UserResource;
    use RainLab\User\Models\User;
    
    // register new user
    class RegisterController {

        // register user
        public function __invoke() {
            $name = post("name");
            $surname = post("surname");
            $email = post("email");
            $password = post("password");
            $password_confirmation = post("password_confirmation");
            $activation_code = $this->generateCode();

            $user = Auth::register([
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "password" => $password,
                "password_confirmation" => $password_confirmation
            ]);
            $user->activation_code = $activation_code;
            $user->sent_code_at = now();
            $user->save();
            $this->sendMail($user);

            return new UserResource($user);
        }

        // send activation email to user
        private function sendMail($user) {
            $params = [
                "name" => $user->name,
                "activation_code" => $user->activation_code
            ];

            Mail::send("libuser.userapi::mail.activate", $params, function($message) use ($user) {
                $message->to($user->email);
                $message->subject("Activate account");
            });
        }

        // resend activation code to user
        function resendCode() {
            $user = User::where("email", post("email"))->first();

            if ($user->is_activated) {
                return response()->json(["error" => "User is already active"]);
            }

            $user->activation_code = $this->generateCode();
            $user->sent_code_at = now();
            $user->save();
            $this->sendMail($user);
            return new UserResource($user);
        }

        // generate activation code for user
        private function generateCode() {
            $activation_code = rand(100000, 999999);
            return $activation_code;
        }

    };