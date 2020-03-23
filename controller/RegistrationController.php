<?php


class RegistrationController
{
    static public function index(IRequest $request,IResponse $response){
        $user = $request->getUser();
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $registration = $_SERVER['REGISTRATION_REPO']->retrieve('id',$id);
                $view = $_SERVER['TEMPLATE_SERVICE']->getProfile('REGISTRATION',$user,$registration);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $registrations = $_SERVER['REGISTRATION_REPO']->retrieve('attendee',$user->id);
            $view = $_SERVER['TEMPLATE_SERVICE']->getList('REGISTRATION',$user,$registrations);
            $response->render($view);
        }
    }
}