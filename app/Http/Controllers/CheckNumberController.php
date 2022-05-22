<?php

namespace App\Http\Controllers;

//use http\Client\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckNumberController extends Controller
{
    public function check_number(Request $request)
    {
        $min = 1;
        $max = 10000000000;
        $isValid = Validator::make($request->all(), [
            'number_to_check' => 'required|integer|max:' . $max . '|min:' . $min,
        ]);
        if ($isValid->fails()) {
            return response()->json([
                'message' => 'Errors in data.',
                'errors' => $isValid->errors()
            ], 400);
        }

        $number = (integer)$request->post('number_to_check');

        if ($number === $min) {
            return response([
                'message' => 'Success',
                'number' => 'The number you entered was "' . $min . '".'
            ], 200);
        } elseif ($number === $max) {
            return response([
                'message' => 'Success',
                'number' => 'The number you entered was "' . $max . '".'
            ], 200);
        }

        $aux = $this->process_action($number);

        return $this->execute_loop($aux->i_min, $aux->i_max, $number);

    }

    public function process_action($number)
    {
        $aux = (object)[
            'i_min' => 1,
            'i_max' => 10000000000
        ];
        switch ($number) {
            case $number > 1 && $number <= 1000000000 :
            {
                $aux->i_min = 2;
                $aux->i_max = 1000000000;
                return $aux;
            }
            case $number > 1000000000 && $number <= 2000000000 :
            {
                $aux->i_min = 1000000001;
                $aux->i_max = 2000000000;
                return $aux;
            }
            case $number > 2000000000 && $number <= 3000000000 :
            {
                $aux->i_min = 2000000001;
                $aux->i_max = 3000000000;
                return $aux;
            }
            case $number > 3000000000 && $number <= 4000000000 :
            {
                $aux->i_min = 3000000001;
                $aux->i_max = 4000000000;
                return $aux;
            }
            case $number > 4000000000 && $number <= 5000000000 :
            {
                $aux->i_min = 4000000001;
                $aux->i_max = 5000000000;
                return $aux;
            }
            case $number > 5000000000 && $number <= 6000000000 :
            {
                $aux->i_min = 5000000001;
                $aux->i_max = 6000000000;
                return $aux;
            }
            case $number > 6000000000 && $number <= 7000000000 :
            {
                $aux->i_min = 6000000001;
                $aux->i_max = 7000000000;
                return $aux;
            }
            case $number > 7000000000 && $number <= 8000000000 :
            {
                $aux->i_min = 7000000001;
                $aux->i_max = 8000000000;
                return $aux;
            }
            case $number > 8000000000 && $number <= 9000000000 :
            {
                $aux->i_min = 8000000001;
                $aux->i_max = 9000000000;
                return $aux;
            }
            case $number > 9000000000 && $number <= 10000000000 :
            {
                $aux->i_min = 9000000001;
                $aux->i_max = 10000000000;
                return $aux;
            }
        }
    }

    public function execute_loop($min, $max, $number)
    {
        $aux = $max / 2;
        switch ($number) {
            case $number >= $aux :
            {
                $min = (integer)$aux;
                for ($i = $min; $i <= $max; $i++) {
                    if ($i == $number) {
                        return response([
                            'message' => 'Success',
                            'number' => 'The number you entered was "' . $i . '".'
                        ], 200);
                    }
                }

            }
            case $number < $aux :
            {
                $max = (integer)$aux;
                for ($i = $min; $i <= $max; $i++) {
                    if ($i == $number) {
                        return response([
                            'message' => 'Success',
                            'number' => 'The number you entered was "' . $i . '".'
                        ], 200);
                    }
                }

            }
        }
    }
}
