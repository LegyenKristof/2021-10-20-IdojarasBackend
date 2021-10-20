<?php

class Idojaras {

    private $id;
    private $datum;
    private $hofok;
    private $leiras;

    public function __construct(DateTime $datum, int $hofok, string $leiras) {
        $this->datum = $datum;
        $this->hofok = $hofok;
        $this->leiras = $leiras;
    }
    
    public static function osszes() : array {
        global $db;        
        $t = $db->query("SELECT * FROM adatok ORDER BY datum DESC")
            ->fetchAll();
        $eredmeny = [];

        foreach ($t as $elem) {
            $idojaras = new Idojaras(new DateTime($elem["datum"]), $elem["hofok"], $elem["leiras"]);
            $idojaras->id = $elem["id"];
            $eredmeny[] = $idojaras;
        }

        return $eredmeny;
    }

    public function mentes(){
        global $db;

        $db->prepare("INSERT INTO adatok (datum, hofok, leiras) VALUES (:datum, :hofok, :leiras)")
            ->execute([":datum" => $this->datum->format("Y-m-d"),
                        ":hofok" => $this->hofok,
                        ":leiras" => $this->leiras
        ]);
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function getDatum() : DateTime {
        return $this->datum;
    }

    public function getHofok() : int {
        return $this->hofok;
    }

    public function getLeiras() : string {
        return $this->leiras;
    }

}

?>