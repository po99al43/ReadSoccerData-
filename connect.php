<?php

class Connect
{
    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=gamelist;port=3306", "root", "");
        $this->db->exec("set names utf8");
    }

    public function savegame($data)
    {
        foreach ($data as $k => $v) {
            $iD = $data[$k][0];
            $event = $data[$k][2];
            $time = $data[$k][1];
            $game = $data[$k][5]."#".$data[$k][6]."#".$data[$k][7];
            $capot = $data[$k][15]."#".$data[$k][16]."#".$data[$k][17];
            $o_concede_points = $data[$k][9]."#".$data[$k][10];
            $o_size = $data[$k][14]."#".$data[$k][13];
            $single_dual = $data[$k][18].$data[$k][20]."#".$data[$k][19].$data[$k][21];
            $capot2 = $data[$k][31]."#".$data[$k][32]."#".$data[$k][33];
            $h_concede_points = $data[$k][25]."#".$data[$k][26];
            $h_size = $data[$k][30]."#".$data[$k][29];

            $cmd = "REPLACE INTO `game` (`iD`, `event`, `time`, `game`, `capot`, `o_concede_points`, `o_size`, `single_dual`, `capot2`, `h_concede_points`, `h_size`)".
                    "VALUES (:id, :event, :time, :game, :capot, :o_concede_points, :o_size, :single_dual, :capot2, :h_concede_points, :h_size) ";
            $result = $this->db->prepare($cmd);
            $result->bindParam(':id', $iD);
            $result->bindParam(':event', $event);
            $result->bindParam(':time', $time);
            $result->bindParam(':game', $game);
            $result->bindParam(':capot', $capot);
            $result->bindParam(':o_concede_points', $o_concede_points);
            $result->bindParam(':o_size', $o_size);
            $result->bindParam(':single_dual', $single_dual);
            $result->bindParam(':capot2', $capot2);
            $result->bindParam(':h_concede_points', $h_concede_points);
            $result->bindParam(':h_size', $h_size);
            $result->execute();
        }
    }

    public function getgame()
    {
        $cmd = "SELECT * FROM `game`";
        $result = $this->db->prepare($cmd);
        $result->execute();
        $alldat = $result->fetchAll(PDO::FETCH_ASSOC);
        return $alldat;
    }

    public function __destruct()
    {
        $this->db = null;
    }
}