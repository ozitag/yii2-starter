<?php
    function check($arr){
        if(is_array(json_decode($arr))){
            $html = '<ul>';
            foreach (json_decode($arr) as $item) {
                $html .= "<li>$item</li>";
            }
            $html .= "</ul>";
            return $html;
        } else return $arr;
    }
?>
<style>
    .row{

    }
    .row2{

    }
    .row div{
        display: inline-block;
        vertical-align: top;
    }
    .sidebar{
        width: 280px;
        margin-right: 50px;
    }
    .container{
        width: 800px;
        margin: 0 auto;
    }
    .image{
        background: #0c5460;
        width: 280px;
        height: 280px;
        margin-right: 50px;
    }
    .box{
        margin-bottom: 20px;
    }
    h1{
        font-size: 40px;
    }
    h2,h3{
        color: #b40000;
    }
    h3{
        margin-bottom: 5px;
    }
    hr{
        margin: 20px 0;
    }
</style>

<div class="container" style="padding-top: 80px;">
    <div class="row">
        <div class="image">

        </div>
        <div class="header">
            <h1><?= $resume->id ?></h1>
            <h2><?= $resume->profession ?></h2>
        </div>
    </div>
    <div class="about">
        <h3>GET TO KNOW ME</h3>
        <span><?= $resume->about ?></span>
    </div>
    <hr>
    <table>
        <tr>
            <td valign="top">
                <div class="sidebar">
                    <div class="box">
                        <h3>CORE COMPETENCIES</h3>
                        <span><?= check($resume->competencies) ?></span>
                    </div>
                    <div class="box">
                        <h3>TECHNICAL SKILLS</h3>
                        <span><?= check($resume->skills) ?></span>
                    </div>
                    <div class="box">
                        <h3>EDUCATION</h3>
                        <span><?= check($resume->education) ?></span>
                    </div>
                    <div class="box">
                        <h3>COURSES & CERTIFICATES</h3>
                        <span><?= check($resume->courses) ?></span>
                    </div>
                    <div class="box">
                        <h3>ENGLISH LEVEL</h3>
                        <span><?= $resume->english ?></span>
                    </div>
                </div>
            </td>
            <td valign="top">
                <div class="content">
                    <?= $resume->experience ?>
                </div>
            </td>
        </tr>
    </table>


    </div>
</div>
