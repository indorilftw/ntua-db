<?php
    function checkCreate( $chkid, $pid, $umn, $created, $duration, $score) {
        db(
            "INSERT INTO
                checks
            SET
                chkid = :chkid,
                pid = :pid,
                umn = :umn,
                created = :created,
                duration = :duration,
                score = :score",
            compact( 'chkid', 'pid', 'umn', 'created', 'duration', 'score')
        );
    }
    function checkListing() {
        $res = db(
            "SELECT
                e.name, t.name, ct.name, c.score, c.created, c.pid, c.duration, c.chkid, c.umn
             FROM 
                 checks c
             INNER JOIN 
                 planes p
             ON 
                 c.pid = p.pid
                 INNER JOIN
                     types t
                 ON
                     p.tid = t.tid
                     INNER JOIN
                         checktypes ct
                     ON
                         c.chkid = ct.chkid
                         INNER JOIN
                             employees e
                         ON
                             e.umn = c.umn
                         ORDER BY c.pid",
            compact( 'chkid', 'pid', 'umn' )
            );
        $rows = array();
        while ( $row = mysql_fetch_array( $res ) ) {
            $rows[] = $row;
        }
        return $rows;
    }
    function checkDelete( $chkid , $pid , $umn ) {
        db(
            "DELETE FROM
                checks
            WHERE
                chkid = :chkid
                AND
                pid = :pid
                AND
                umn = :umn
            LIMIT 1",
            compact( 'chkid', 'pid', 'umn' )
        );
    }
    function checkUpdate( $chkid, $pid, $umn, $created, $duration, $score ) {
        db(
            "UPDATE
                checks
            SET
                created = :created,
                duration = :duration,
                score = :score
            WHERE
                chkid = :chkid
                AND
                pid = :pid
                AND
                umn = :umn
            LIMIT 1",
            compact( 'chkid', 'pid', 'umn', 'created', 'duration', 'score')
        );
    }
    function checkItem( $chkid , $pid , $umn ) {
        $res = db(
            "SELECT
                *
            FROM
                checks
            WHERE
                chkid = :chkid
                AND
                pid = :pid
                AND
                umn = :umn
            LIMIT 1",
            compact( 'chkid', 'pid', 'umn' )
        );
        return mysql_fetch_array( $res );
    }
?>
