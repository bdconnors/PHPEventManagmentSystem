<?php


class VenueController {
    static public function index( $request, $response){
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
    static public function updateForm( $request, $response){
        $user = $request->getUser();
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $valid = $_SERVER['VALIDATION']->validatePosInteger($id);
            if($valid){
                $venue = $_SERVER['VENUE_REPO']->retrieve('id',$id)[0];
                $view = $_SERVER['TEMPLATE_SERVICE']->getEditVenue($user,$venue);
                $response->render($view);
            }else{
                $view = $_SERVER['TEMPLATE_SERVICE']->getError('Page Not Found');
                $response->render($view);
            }
        }else{
            $response->redirect('/venues');
        }
    }
    static public function createForm( $request, $response){
        $view = $_SERVER['TEMPLATE_SERVICE']->getCreateVenue($request->getUser());
        $response->render($view);
    }
    static public function update( $request, $response){
        $_SERVER['VENUE_SERVICE']->update($request,$response);
    }
    static public function create( $request, $response){
        $_SERVER['VENUE_SERVICE']->create($request,$response);
    }
    static public function delete( $request, $response){
        $_SERVER['VENUE_SERVICE']->delete($request,$response);
    }
}