<?php
require __DIR__ . "/bootstrap.php";

function  __Exit()
{
    header("Content-Type: application/json");
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(["error" => "invalid param, {Controller}/{method}/{id}"]);
}


$uriResult = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uriResult);



//if no controller called then exit
isset($uri[3]) ? define("CONTROLLER", strtolower($uri[3])) : __Exit();
//action method
isset($uri[4]) ? define("ACTION", strtolower($uri[4])) : "";
//id
isset($uri[5]) ? define("ID", (int)$uri[5]) : "";


//check if USER controller is called
// api/users
// api/users/create
// api/users/update/{id}
// api/users/delete/{id}
if (CONTROLLER == "users") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\UsersController.php";
    $users = new UsersController();

    //ACTION is Action method >>  api/users/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $users->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/users/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $users->Details(ID);
                        break;
                    case "update":
                        $users->Update(ID);
                        break;
                    case "delete":
                        $users->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/users
    else :
        $users->Index();
    endif;

    exit();
}

//check if category controller is called
// api/category
// api/category/create
// api/category/update/{id}
// api/category/delete/{id}
if (CONTROLLER == "category") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\categoryController.php";
    $category = new categoryController();

    //ACTION is Action method >>  api/category/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $category->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/category/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $category->Details(ID);
                        break;
                    case "update":
                        $category->Update(ID);
                        break;
                    case "delete":
                        $category->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/category
    else :
        $category->Index();
    endif;

    exit();
}

//check if user message controller is called
// api/message
// api/message/create
// api/message/delete/{id}
if (CONTROLLER == "message") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\UserMsgController.php";
    $userMsg = new userMsgController();

    //ACTION is Action method >>  api/message/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $userMsg->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/message/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $userMsg->Details(ID);
                        break;
                    case "delete":
                        $userMsg->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/message
    else :
        $userMsg->Index();
    endif;

    exit();
}


//check if slider controller is called
// api/slider
// api/slider/create
// api/slider/update/{id}
// api/slider/delete/{id}
if (CONTROLLER == "slider") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\sliderController.php";
    $slider = new SliderController();

    //ACTION is Action method >>  api/slider/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $slider->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/slider/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $slider->Details(ID);
                        break;
                    case "update":
                        $slider->Update(ID);
                        break;
                    case "delete":
                        $slider->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/slider
    else :
        $slider->Index();
    endif;

    exit();
}



//check if special controller is called
// api/special
// api/special/create
// api/special/update/{id}
// api/special/delete/{id}
if (CONTROLLER == "special") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\SpecialSectionController.php";
    $special = new SpecialSectionController();

    //ACTION is Action method >>  api/special/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $special->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/special/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $special->Details(ID);
                        break;
                    case "update":
                        $special->Update(ID);
                        break;
                    case "delete":
                        $special->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/special
    else :
        $special->Index();
    endif;

    exit();
}

//check if month_special controller is called
// api/month_special
// api/month_special/create
// api/month_special/update/{id}
// api/month_special/delete/{id}
if (CONTROLLER == "month_special") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\MonthSpecialsController.php";
    $month_special = new MonthSpecialsController();

    //ACTION is Action method >>  api/month_special/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $month_special->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/month_special/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $month_special->Details(ID);
                        break;
                    case "update":
                        $month_special->Update(ID);
                        break;
                    case "delete":
                        $month_special->Delete(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/month_special
    else :
        $month_special->Index();
    endif;

    exit();
}


//check if menu controller is called
// api/menu
// api/menu/create
// api/menu/update/{id}
// api/menu/delete/{id}

// api/menu/index/{category id}
if (CONTROLLER == "menu") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\MenuController.php";
    $menu = new MenuController();

    //ACTION is Action method >>  api/menu/{ActionMethod}/{ID}
    //ID is id
    if (defined("ACTION")) :
        //if equal create, then create user
        if (ACTION === "create") :
            $menu->Create();
        //else, it is mean the action method(details,update,delete) is call
        // all these methods required {ID}
        else :
            //check if {ID} is set
            if (defined("ID")) :
                //choose action method
                //api/menu/{ACTION_METHOD}/{ID}
                switch (ACTION):
                    case "details":
                        $menu->Details(ID);
                        break;
                    case "update":
                        $menu->Update(ID);
                        break;
                    case "delete":
                        $menu->Delete(ID);
                        break;
                    case "index":
                        $menu->GetAllByCategory(ID);
                        break;
                endswitch;
            //if {ID} not set
            else :
                __Exit();
            endif;
        endif;
    //if there no action method called then its mean get all data: INDEX
    //http://localhost:81/POB-TASKS/task23/api/menu
    else :
        $menu->Index();
    endif;

    exit();
}





/* */
//check if Home controller is called
// api/home
// api/home/create
// api/home/update
// api/home/delete
if (CONTROLLER == "home") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\HomeController.php";
    $home = new HomeController();
    //ACTION is Action method >>  api/home/{ActionMethod}
    if (defined("ACTION")) {
        //if equal create, then create user
        if (ACTION === "create")
            $home->Create();
        else if (ACTION == "update")
            $home->Update();
        else if (ACTION == "delete")
            $home->Delete();
        else __Exit();
    } else {
        $home->Index();
    }
    exit();
}
//check if about controller is called
// api/about
// api/about/create
// api/about/update
// api/about/delete
if (CONTROLLER == "about") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\AboutController.php";
    $about = new AboutController();
    //ACTION is Action method >>  api/about/{ActionMethod}
    if (defined("ACTION")) {
        //if equal create, then create user
        if (ACTION === "create")
            $about->Create();
        else if (ACTION == "update")
            $about->Update();
        else if (ACTION == "delete")
            $about->Delete();
        else __Exit();
    } else {
        $about->Index();
    }
    exit();
}
if (CONTROLLER == "contact") {
    //require controller
    require_once PROJECT_ROOT_PATH . "\Controller\ContactController.php";
    $contact = new ContactController();
    //ACTION is Action method >>  api/contact/{ActionMethod}
    if (defined("ACTION")) {
        //if equal create, then create user
        if (ACTION === "create")
            $contact->Create();
        else if (ACTION == "update")
            $contact->Update();
        else if (ACTION == "delete")
            $contact->Delete();
        else __Exit();
    } else {
        $contact->Index();
    }
    exit();
}

__Exit();
