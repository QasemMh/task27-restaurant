<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



class SliderController extends BaseController
{
    private $RequestMethod = "GET";
    private $ErrorDesc = "";
    private $ErrorHeader = "";

    public function Index($limit = 100)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($this->RequestMethod) == 'GET') {

            try {
                $sliderModel = new Slider();

                if (
                    isset($arrQueryStringParams['limit'])
                    && $arrQueryStringParams['limit']
                ) {
                    $limit = (int)$arrQueryStringParams['limit'];
                }

                $arrslider = $sliderModel->getAll($limit)->fetchAll(PDO::FETCH_ASSOC);
                $responseData = json_encode($arrslider);
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }


        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }

    public function Details($id)
    {

        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'GET') {
            try {
                $sliderModel = new  Slider();

                $arrslider = $sliderModel->getBy($id);
                if ($arrslider->rowCount() > 0) {
                    $responseData = json_encode($arrslider->fetch(PDO::FETCH_ASSOC));
                } else {
                    $this->SetError("slider not Found", "HTTP/1.1 404 not Found");
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorDesc)
            );
        }
    }

    public function Create()
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $sliderModel = new Slider();

                //save image to database and server
                $path = "path";
                if (isset($_FILES["path"]) && $_FILES["path"]["error"] == UPLOAD_ERR_OK) {
                    $filename = $_FILES["path"]["name"];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $tempName = $_FILES["path"]["tmp_name"];
                    $path   = uniqid(true) . "." . $ext;
                    move_uploaded_file($tempName, "D:\\Program File\\xampp\htdocs\\task27_1\image\\" . $path);
                }

                //get text values
                $input = $_POST;
                $input += ["path" => $path];

                $isCreated = $sliderModel->create($input);

                if ($isCreated) {
                    $responseData = json_encode(["message" => "slider Created"]);
                } else {
                    $this->SetError(
                        'slider NOT Created, try again!',
                        'HTTP/1.1 400 Bad Request'
                    );
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }
    public function Update($id)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $sliderModel = new Slider();
                //get text values
                $input = $_POST;
                $input += ["path" => $input["path2"]];
                if (isset($_FILES["path"]) && $_FILES["path"]["error"] == UPLOAD_ERR_OK) {
                    $filename = $_FILES["path"]["name"];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $tempName = $_FILES["path"]["tmp_name"];
                    $path   = uniqid(true) . "." . $ext;
                    move_uploaded_file($tempName, "D:\\Program File\\xampp\htdocs\\task27_1\image\\" . $path);
                    $input["path"] = $path;
                }

                $isUpdate = $sliderModel->update($input, $id);
                if ($isUpdate) {
                    $responseData = json_encode(["message" => "slider Updated"]);
                } else {
                    $responseData = json_encode(["message" => "slider NOT Updated, try again!"]);
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorDesc)
            );
        }
    }

    public function Delete($id)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($this->RequestMethod) == 'POST') {

            try {
                $sliderModel = new  Slider();

                $arrslider = $sliderModel->getBy($id);
                if ($arrslider->rowCount() > 0) {
                    $sliderModel->delete($id);
                    $responseData = json_encode(["message" => "slider deleted"]);
                } else {
                    $this->SetError("slider not Found", "HTTP/1.1 404 not Found");
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }




    private function SetError($errorDesc, $errorheader)
    {
        $this->ErrorDesc = $errorDesc;
        $this->ErrorHeader = $errorheader;
    }
}
