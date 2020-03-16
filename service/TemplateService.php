<?php

require_once './view/EventProfile.php';
require_once './view/EventList.php';
require_once './view/LoginForm.php';
require_once './view/Dashboard.php';
require_once './view/VenueProfile.php';
require_once './view/VenueList.php';
require_once './view/CreateAccountForm.php';
class TemplateService {

    protected Validation $validation;
    public function __construct($validation){
        $this->validation = $validation;
    }
    public function getAccountCreationForm(IRequest $request){
        return new CreateAccountForm($request->getUser());
    }
    public function getDashboardTemplate(IRequest $request){
        return new Dashboard($request->getUser());
    }
    public function getEventsTemplate(IRequest $request){
        $view = new EventList($request->getUser(),$_SERVER['EVENT_REPO']->retrieveAll());
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $validEvent = $this->validation->validateNumber($id);
            if ($validEvent) {
                $event = $_SERVER['EVENT_REPO']->retrieve('id', $id)[0];
                $user = $request->getUser();
                $view = new EventProfile($user, $event);
            }
        }
        return $view;
    }
    public function getVenuesTemplate(IRequest $request){
        $view = new VenueList($request->getUser(),$_SERVER['VENUE_REPO']->retrieveAll());
        if($request->hasParam('id')) {
            $id = $request->query('id');
            $validVenue = $this->validation->validateNumber($id);
            if ($validVenue) {
                $venue = $_SERVER['VENUE_REPO']->retrieve('id', $id)[0];
                $user = $request->getUser();
                $view = new VenueProfile($user, $venue);
            }
        }
        return $view;
    }
    public function getLoginForm(){
        return new LoginForm('');
    }

}