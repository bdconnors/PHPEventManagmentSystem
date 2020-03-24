<?php

require_once './view/builder/NavigationBuilder.php';
require_once './view/component/NavItem.php';
class Navigation implements ITemplate {
    public $user;
    public function __construct($user = null){
        $this->user = $user;
    }

    public function __toString(){
        $nav = $this->buildNav($this->user);
        return $nav->__toString();
    }
    protected function buildNav($account){
        $builder = new NavigationBuilder();
        $nav = $this->makeDefaultNav($builder);
        if(!empty($account)) {
            $builder->buildAccountPanel($account);
            if($account->role->id == 1 || $account->role->id == 2) {
                $nav = $this->makeAdminNav($builder);
            }else if($account->role->id == 3){
                $nav = $this->makeManagerNav($builder);
            }else if($account->role->id == 4) {
                $nav = $this->makeAttendeeNav($builder);
            }
        }
        return $nav;
    }
    protected function makeDefaultNav(NavigationBuilder $builder){
        return $builder->produce();
    }
    protected function makeAttendeeNav(NavigationBuilder $builder){
        $pages = [
            new NavItem('Home','/'),
            new NavItem('Events','/events'),
            new NavItem('Registrations','/registrations')
        ];
        $builder->buildNavItems($pages);
        return $builder->produce();
    }
    protected function makeManagerNav(NavigationBuilder $builder){
        $pages = [
            new NavItem('Home','/'),
            new NavItem('Events','/events'),
            new NavItem('Registrations','/registrations')
        ];
        $builder->buildNavItems($pages);
        return $builder->produce();
    }
     protected function makeAdminNav(NavigationBuilder $builder){
         $pages = [
             new NavItem('Home','/'),
             new NavItem('Accounts','/accounts'),
             new NavItem('Events','/events'),
             new NavItem('Venues','/venues'),
             new NavItem('Registrations','/registrations')
         ];
         $builder->buildNavItems($pages);
         return $builder->produce();
    }

}