<?php


class VenueController {
    static public function index(IRequest $request,IResponse $response){
        $user = $request->getUser();
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $venue = $_SERVER['VENUE_REPO']->retrieve('id',$id)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getProfile('VENUE',$user,$venue);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $venues = $_SERVER['VENUE_REPO']->retrieveAll();
            $view = $_SERVER['TEMPLATE_SERVICE']->getList('VENUE',$user,$venues);
            $response->render($view);
        }
    }
    static public function createForm(IRequest $request,IResponse $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getCreateVenue($request->getUser());
        $response->render($view);
    }
    static public function create(IRequest $request,IResponse $response){
        $_SERVER['ADMIN_SERVICE']->createVenue($request,$response);
    }
    static public function delete(IRequest $request,IResponse $response){
        $_SERVER['ADMIN_SERVICE']->deleteVenue($request,$response);
    }
}