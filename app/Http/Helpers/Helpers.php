<?php

use App\Models\Product;
//ENVIAR A  SUNAT
if (!function_exists('enviarComprobanteapi')) {
    function enviarComprobanteapi($comprobante)
    {
        $url = "https://facturacion.apisperu.com/api/v1/invoice/send";
        $client = new \GuzzleHttp\Client(['verify'=>false]);
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzM0NjcxMzgsImV4cCI6NDc4NzA2NzEzOCwidXNlcm5hbWUiOiJMZXN0ZXIiLCJjb21wYW55IjoiMTA4MDIzOTgzMDcifQ.YjQK8uvUFn8glmKHwDdPXfhqCIBUU51Rl5hF1OKZ9BC0QDcbPFelunk_mXws9k6wqrXvISitKwVltlpdPfrbx9NoU0sygEhIyr4EanYYdthvtRj18X_bki_fk90sRi1AKf0rXHObVGeXZtdAYIwvYQRy_PmUORJlmJf_K6EYpO6tFib529Eqzs0DaiOVR4k21nCI3u7RDUFlABJMv75IpS24jL9WmtwptkswuskpotC4tbr6FUll7Yk1lG3kniFqf60G0nA30HUpctmjQY7oPCjEySLsjGYqnE78l7r5bdHi9TTUaRr3U4gsdvO39Uzw_TmOm9PxArYd2z19iBoQ3eoF-pYBk3V8xjUCy3-zXzE_2aq3jzZvMoUy7L89iXw2zODca3JcszM_BM2gxx97ulTm62lGPYiPLW1hLath3HvwyYNGH6Xihd9I-xNNwK3MGiNnbbmNqKh5FPGK-DIBLfnm4y0QJil0lM89jXjaaTeNOHuN8By45mKrzG6jZSxY8pG-YoncHMRMRwzMXu6SxjQgWuDvXk53BMnw3xOtvA1QwslJmnhblpiG9-_AAWDSQuQXmz4mQaK375aSGLc8QHXjarKuq6ToXVoF29hBh9CWuXt7F_5wa54Xbq6J_EPNtu4vdG3vrul_Q2zSuMMQRZygjDIJd8mT37200Ft3CLc';
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            'body'    => $comprobante
        ]);

        $estado = $response->getStatusCode();

        if ($estado == '200') {

            $resultado = $response->getBody()->getContents();
            json_decode($resultado);
            return $resultado;
        }
    }
}

//GENERAR PDF
if (!function_exists('generarComprobanteapi')) {
    function generarComprobanteapi($comprobante)
    {
        $url = "https://facturacion.apisperu.com/api/v1/invoice/pdf";
        $client = new \GuzzleHttp\Client(['verify'=>false]);
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzM0NjcxMzgsImV4cCI6NDc4NzA2NzEzOCwidXNlcm5hbWUiOiJMZXN0ZXIiLCJjb21wYW55IjoiMTA4MDIzOTgzMDcifQ.YjQK8uvUFn8glmKHwDdPXfhqCIBUU51Rl5hF1OKZ9BC0QDcbPFelunk_mXws9k6wqrXvISitKwVltlpdPfrbx9NoU0sygEhIyr4EanYYdthvtRj18X_bki_fk90sRi1AKf0rXHObVGeXZtdAYIwvYQRy_PmUORJlmJf_K6EYpO6tFib529Eqzs0DaiOVR4k21nCI3u7RDUFlABJMv75IpS24jL9WmtwptkswuskpotC4tbr6FUll7Yk1lG3kniFqf60G0nA30HUpctmjQY7oPCjEySLsjGYqnE78l7r5bdHi9TTUaRr3U4gsdvO39Uzw_TmOm9PxArYd2z19iBoQ3eoF-pYBk3V8xjUCy3-zXzE_2aq3jzZvMoUy7L89iXw2zODca3JcszM_BM2gxx97ulTm62lGPYiPLW1hLath3HvwyYNGH6Xihd9I-xNNwK3MGiNnbbmNqKh5FPGK-DIBLfnm4y0QJil0lM89jXjaaTeNOHuN8By45mKrzG6jZSxY8pG-YoncHMRMRwzMXu6SxjQgWuDvXk53BMnw3xOtvA1QwslJmnhblpiG9-_AAWDSQuQXmz4mQaK375aSGLc8QHXjarKuq6ToXVoF29hBh9CWuXt7F_5wa54Xbq6J_EPNtu4vdG3vrul_Q2zSuMMQRZygjDIJd8mT37200Ft3CLc';
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            'body'    => $comprobante
        ]);

        $estado = $response->getStatusCode();

        return $response->getBody()->getContents();

        dd($response->getBody()->getContents());
        if ($estado == '200') {

            $resultado = $response->getBody()->getContents();
            json_decode($resultado);
            return $resultado;
        }
    }
}

//GENERAR XML
if (!function_exists('generarQrApi')) {
    function generarQrApi($comprobante, $empresa)
    {
        $url = "https://facturacion.apisperu.com/api/v1/sale/qr";
        $client = new \GuzzleHttp\Client(['verify'=>false]);
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzM0NjcxMzgsImV4cCI6NDc4NzA2NzEzOCwidXNlcm5hbWUiOiJMZXN0ZXIiLCJjb21wYW55IjoiMTA4MDIzOTgzMDcifQ.YjQK8uvUFn8glmKHwDdPXfhqCIBUU51Rl5hF1OKZ9BC0QDcbPFelunk_mXws9k6wqrXvISitKwVltlpdPfrbx9NoU0sygEhIyr4EanYYdthvtRj18X_bki_fk90sRi1AKf0rXHObVGeXZtdAYIwvYQRy_PmUORJlmJf_K6EYpO6tFib529Eqzs0DaiOVR4k21nCI3u7RDUFlABJMv75IpS24jL9WmtwptkswuskpotC4tbr6FUll7Yk1lG3kniFqf60G0nA30HUpctmjQY7oPCjEySLsjGYqnE78l7r5bdHi9TTUaRr3U4gsdvO39Uzw_TmOm9PxArYd2z19iBoQ3eoF-pYBk3V8xjUCy3-zXzE_2aq3jzZvMoUy7L89iXw2zODca3JcszM_BM2gxx97ulTm62lGPYiPLW1hLath3HvwyYNGH6Xihd9I-xNNwK3MGiNnbbmNqKh5FPGK-DIBLfnm4y0QJil0lM89jXjaaTeNOHuN8By45mKrzG6jZSxY8pG-YoncHMRMRwzMXu6SxjQgWuDvXk53BMnw3xOtvA1QwslJmnhblpiG9-_AAWDSQuQXmz4mQaK375aSGLc8QHXjarKuq6ToXVoF29hBh9CWuXt7F_5wa54Xbq6J_EPNtu4vdG3vrul_Q2zSuMMQRZygjDIJd8mT37200Ft3CLc';
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            'body'    => $comprobante
        ]);

        $estado = $response->getStatusCode();

        return $response->getBody();

        // dd( $response->getBody()->getContents());
        if ($estado == '200') {

            $resultado = $response->getBody()->getContents();
            json_decode($resultado);
            return $resultado;
        }
    }
}

//GENERAR XML
if (!function_exists('generarXmlapi')) {
    function generarXmlapi($comprobante, $empresa)
    {
        $url = "https://facturacion.apisperu.com/api/v1/invoice/xml";
        $client = new \GuzzleHttp\Client(['verify'=>false]);
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzM0NjcxMzgsImV4cCI6NDc4NzA2NzEzOCwidXNlcm5hbWUiOiJMZXN0ZXIiLCJjb21wYW55IjoiMTA4MDIzOTgzMDcifQ.YjQK8uvUFn8glmKHwDdPXfhqCIBUU51Rl5hF1OKZ9BC0QDcbPFelunk_mXws9k6wqrXvISitKwVltlpdPfrbx9NoU0sygEhIyr4EanYYdthvtRj18X_bki_fk90sRi1AKf0rXHObVGeXZtdAYIwvYQRy_PmUORJlmJf_K6EYpO6tFib529Eqzs0DaiOVR4k21nCI3u7RDUFlABJMv75IpS24jL9WmtwptkswuskpotC4tbr6FUll7Yk1lG3kniFqf60G0nA30HUpctmjQY7oPCjEySLsjGYqnE78l7r5bdHi9TTUaRr3U4gsdvO39Uzw_TmOm9PxArYd2z19iBoQ3eoF-pYBk3V8xjUCy3-zXzE_2aq3jzZvMoUy7L89iXw2zODca3JcszM_BM2gxx97ulTm62lGPYiPLW1hLath3HvwyYNGH6Xihd9I-xNNwK3MGiNnbbmNqKh5FPGK-DIBLfnm4y0QJil0lM89jXjaaTeNOHuN8By45mKrzG6jZSxY8pG-YoncHMRMRwzMXu6SxjQgWuDvXk53BMnw3xOtvA1QwslJmnhblpiG9-_AAWDSQuQXmz4mQaK375aSGLc8QHXjarKuq6ToXVoF29hBh9CWuXt7F_5wa54Xbq6J_EPNtu4vdG3vrul_Q2zSuMMQRZygjDIJd8mT37200Ft3CLc';
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            'body'    => $comprobante
        ]);

        $estado = $response->getStatusCode();

        return $response->getBody();



        // dd( $response->getBody()->getContents());
        if ($estado == '200') {

            $resultado = $response->getBody()->getContents();
            json_decode($resultado);
            return $resultado;
        }
    }
}

//LLAMADA A NOTIFICACIONES
function notificacion()
{
    return Product::where('stock', '<=', 10)
    ->orderBy('id', 'desc')
    ->get();
}
