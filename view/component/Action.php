<?php


class Action{
    public $title;
    public $description;
    public $img;
    public $href;
    public function __construct($title,$description,$img,$href){
        $this->title = $title;
        $this->description = $description;
        $this->img = $img;
        $this->href = $href;
    }

    public function __toString(){
        return "<div class='col'>
                <div class='card' style='width: 18rem;'>
                    <a href='{$this->href}'><img src='{$this->img}' class='card-img-top'></a>
                    <div class='card-body'>
                        <h5 class='card-title'>{$this->title}</h5>
                        <p class='card-text'>{$this->description}</p>
                    </div></ul></div></div>";
    }

}