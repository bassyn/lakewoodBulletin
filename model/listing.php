<?php

class Listing {
    private $id;
    private $title;
    private $posted_by;
    private $category;
    private $price;
    private $photo;
    private $description;
    private $date_posted;
    private $contact;

    public function __construct($values) {
        $this->id = $this->getValue('id', $values);
        $this->posted_by = $this->getValue('posted_by', $values);
        $this->title = $this->getValue('title', $values);
        $this->category = $this->getValue('category', $values);
        $this->price = $this->getValue('price', $values);
        $this->photo = $this->getValue('photo', $values);
        $this->description = $this->getValue('description', $values);
        $this->date_posted = $this->getValue('date_posted', $values);
        $this->contact = $this->getValue('contact', $values);
    }

    private function getValue($key, $values) {
        if(! empty($values[$key])) {
            return $values[$key];
        }
        return null;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPosted_by() {
        return $this->posted_by;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate_posted() {
        return $this->date_posted;
    }

    public function getContact() {
        return $this->contact;
    }


}
?>