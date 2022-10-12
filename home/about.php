<?php include './includes/nav_bar.php'; ?>
<section>

    <div class = "image float-left">
        
    </div>

    <div class = "content">
        <h2>About Us</h2>
        <span></span>
        <p>Online voting is web based voting system that will help you manage your elections easily and securely.
        This voting system can be used for casting votes during the elections held in colleges,etc.
        In this system the voter do not have to go to the polling booth to cast their vote.
        They can use their personal computer to cast their votes.
        There is a database which is maintained in which all the name of the voters with their complete information stored.</p>

        <ul class = "links">
            <li><a href = "./index.php">Login</a></li>
            <div class = "vertical-line"></div>
            <li><a href = "./index.php">Cast Vote</a></li>
        </ul>
    </div>

</section>

<style>
    section{
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 88vh;
    width: 85vw;
    margin: 0 auto;
    padding: 0px;
    }
    .image{
    background: url("./image_sources/about_pic.jpeg")center/cover no-repeat;
    margin-left:-80px;
    height: 100%;
    }
    .content{
        background: #fff;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
    .content h2{
        text-transform: uppercase;
        font-size: 36px;
        padding: 10px;
        opacity: 0.9;
    }
    .content span{
        height: 0.1px;
        width: 80px;
        background:#777;
    }
    .content p{
        padding-bottom: 15px;
        font-weight: 300;
        opacity: 0.7;
        width: 81%;
        padding:20px;
        text-align: center;
        margin: 0 auto;
        line-height: 1.7;
    }
    .links{
        margin: 0px 0;
        margin-left: -25px;
    }
    .links li{
        border: 0.5px solid #007bff;
        list-style: none;
        border-radius: 5px;
        padding: 10px 15px;
        width: 160px;
        text-align: center;
    }
    .links li a{
        text-transform: uppercase;
        color: #007bff;
        text-decoration: none;
    }
    .links li:hover{
        border-color: #007bff;
    }
    .links li:hover a{
        color :#007bff;
        font-weight: 700;

    }
    .vertical-line{
        height: 30px;
        width: 0.5px;
        background: #007bff;
        margin: 0 auto;
    }

    @media all and (max-width: 1024px){

        section{
            grid-template-columns: 1fr;
            width: 100%;
        }
        .image{
            height: 70vh;
            margin-left: 0px;
        }
        .content{
            height: 100vh;
            margin-top: -50px;
        }
        .content h2{
            font-size: 20px;
            margin-top: -95px;
        }
        .content span{
            margin: 0px 0;
        }
        .content p{
            font-size: 14px;
        }
        .links li a{
            font-size: 14px;
        }
        .links{
            margin: 0px 0;
            margin-left: -20px;
        }
        .links li{
            padding: 6px 10px;
        }
    
    }

</style>
<script>
$(document).ready(function(){
  $('nav ul li a').eq(1).addClass("active");
});
</script>
</body>
</html>