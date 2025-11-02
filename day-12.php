<?php  
    class students {
        public $batchNo = 309;
        public $bachShift;
        public $total;
        protected $floor = 4;

        public function shift($s) {
            $this->bachShift = $s;
        }
    }

    $obj = new students;
    echo $obj->batchNo."\n";
    $obj->shift("Morning");
    echo $obj->bachShift."\n";
    $obj->total = 2000;
    echo $obj->total."\n";
    // echo $obj->floor."\n";

    class candidate extends students {
        public function examShift () {
            $this->shift("Afternoon");
            return $this->bachShift ?? "Not Found";
        }
    }
    $obj2 = new candidate;
    echo $obj2->examShift();

?>