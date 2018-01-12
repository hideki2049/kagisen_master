<?php
include '../DB.php';
$dbh = $pdo;
$dbh->query('SET NAMES utf8');

    $teachercd = $_POST['teachercd'];
    $yearData = $_POST['year'];
    $semesterData = $_POST['semester'];
    $subjectcdData = $_POST['subjectcd'];
    $gradeData = $_POST['grade'];
    $clsData = $_POST['cls'];


    $stmt = $dbh->prepare('select
     an.questnum as number,
     qc.content as question,
     sum(case an.answer when 3 then 1 else 0 end)/count(*) as good,
     sum(case an.answer when 2 then 1 else 0 end)/count(*) as medium,
     sum(case an.answer when 1 then 1 else 0 end)/count(*) as bad
     from t_answer1 an,t_questcontent qc,  t_student st
     where an.questnum = qc.questnum
     and an.year = qc.year
     and an.year = st.year
     and an.studentnum = st.studentnum
     and an.teachercd = ?
     and an.semester = ?
     and an.answer != 0
     and st.subjectcd = ?
     and st.grade = ?
     and st.cls = ?
     and an.year = ?
     group by an.questnum');
    $stmt->execute(array($teachercd,$semesterData,$subjectcdData,$gradeData,$clsData,$yearData));
    $test1 = $stmt->fetchAll();
    $i = 0;
    foreach($test1 as $row){
      $data['g1']['number'][$i] = $row['number'];
      $data['g1']['good'][$i] = $row['good'];
      $data['g1']['medium'][$i] = $row['medium'];
      $data['g1']['bad'][$i] = $row['bad'];
      $i++;
    }

    $stmt = $dbh->prepare('select
     y as year,
     semester1,
     semester2
     from
     (
     select
     date_format(date_add(curdate(), interval td.generate_series year), "%Y") as y
     from
     (
     select 0 generate_series from DUAL where (@num:=-5)*0 union all
     select @num:=@num+1 from `information_schema`.COLUMNS limit 5
     ) as td
     ) as d1
     left outer join
     (
       select
       a.year,
       sum(
        case a.semester
         when "1" then a.answer
         else 0
        end
       )
       /
       sum(
        case a.semester
         when "1" then 3
         else 0
        end
       ) * 100 as semester1,
       sum(
        case a.semester
         when "2" then a.answer
         else 0
        end
       )
       /
       sum(
        case a.semester
         when "2" then 3
         else 0
        end
       ) * 100 as semester2
       from
       t_answer1 a,
       t_student s
       where
       a.year = s.year
       and
       a.studentnum = s.studentnum
       and
       a.answer between 1 and 3
       and
       a.teachercd=?
       and
       s.subjectcd = ?
       and
       s.grade = ?
       and
       s.cls = ?
       group by
       a.year
      ) as d2
      on d1.y = d2.year');
    $stmt->execute(array($teachercd,$subjectcdData,$gradeData,$clsData));
    $test2 = $stmt->fetchAll();
    $i = 0;
    foreach($test2 as $row){
      $data['g2']['year'][$i] = $row['year'];
      $data['g2']['semester1'][$i] = $row['semester1'];
      $data['g2']['semester2'][$i] = $row['semester2'];
      $i++;
    }


echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
