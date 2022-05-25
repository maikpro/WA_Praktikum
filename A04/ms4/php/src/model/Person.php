<?php
class Person
{
    private $id;
    private $vorname;
    private $nachname;
    private $strasse;
    private $plz;
    private $ort;

    public function __construct($id, $vorname, $nachname, $strasse, $plz, $ort)
    {
        $this->id = $id;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->strasse = $strasse;
        $this->plz = $plz;
        $this->ort = $ort;
    }

    /*public function set_vorname($vorname)
    {
        $this->$vorname = $vorname;
    }*/

    public function get_id()
    {
        return $this->id;
    }

    public function get_vorname()
    {
        return $this->vorname;
    }

    public function get_nachname()
    {
        return $this->nachname;
    }

    public function get_strasse()
    {
        return $this->strasse;
    }

    public function get_plz()
    {
        return $this->plz;
    }

    public function get_ort()
    {
        return $this->ort;
    }

    public function __toString()
    {
        return 'Person={ ' . $this->get_id() . ', ' .  $this->get_vorname() . ', ' . $this->get_nachname() . ', ' . $this->get_strasse() . ', ' . $this->get_plz() . ', ' . $this->get_ort() .  ' }';
    }
}
