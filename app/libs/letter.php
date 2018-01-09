<?php
class letter{
    public function newUser($name,$username,$url){
        return "<body style='
    padding: 1%;
    background: #ecf0f1;
'>

<div style='display: flex'>

<h1 style='
    color: #2f3e50;
'>Qourota.me</h1>
</div>

<div style='
    background: white;
    padding: 40px;
'>
<style>
p {
font-weight: 500;
text-transform: capitalize;
font-family: sans-serif;
margin-left: 20px;
color :#2e3e50;

}
</style>
<h2 style='color :#2e3e50;'>hi $name</h2>

<div style='
    border: 1px solid #2f3e50;
    border-radius: 2px;
'>
<h1 style='
    background: #2e3e50;
    text-align: center;
    padding: 10px;
    color: #eee;
    margin: 0;
'>Welcome to Qourota</h1>
<div style='padding: 25px;'>
<p>welcome to qourota you can manage your order <a href='$url/login' style='
    text-decoration: none;
    color: #3498db;
    font-weight: 900;
'>here</a> with your account</p>
<p>for the login you can use your username or your email and your password</p>
<p>Your username : $username</p>
<p>you welcome any time for more information please contact the support</p>
</div>
</div>
</div></body>";
    }
}
