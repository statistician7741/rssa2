<!Doctype html>
<head>
<style>
  * {
  margin:0px;
  padding:0px;
}

body {
  background:url("background.gif");
}

.container {
  width:180px;
  display:block;
  margin:200px auto 0px auto;
}

.con_down {
  display:block;
  transition:.5s all ease;
  cursor:pointer;
  background-color:#F6EB96;
  width:180px;
  padding-left:20px;
  border:2px solid #D8B83C;
  border-bottom-left-radius:5px;
  border-top-left-radius:5px;
  position:relative;
}

h4 {
  line-height:50px;
  color:#895D0A;
  text-align:center;
  text-transform:uppercase;
}

.times {
  background-color:#E3E3E3;
  margin-top:200px;
  width:140px;
  margin-left:42px;
  z-index:-9;
  border:1px solid #AAA9A9;
  position:absolute;
  transition:.5s all ease-in-out;
  top:10px;
}

.time {
  line-height:30px;
  text-align:center;
  color:#4B4B4B;
}

.times_abs {
  background-color:#F6EB96;
  cursor:pointer;
  width:20px;
  border-top:2px solid #D8B83C;
  border-right:2px solid #D8B83C;
  border-bottom:2px solid #D8B83C;
  border-bottom-right-radius:5px;
  border-top-right-radius:5px;
  height:50px;
  position:absolute;
  top:0;
  margin-left:200px;
  margin-top:200px;
  transition:.5s all ease-in-out;
}

.me {
  text-align:center;
  margin-left:40px;
  color:#4B4B4B;
  margin-top:10px;
}

a {
  color:#4B4B4B;
  transition:.2s all ease-out;
  text-decoration:none;
}


  </style>
  
  <style>
  .modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.8);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}

	.modalDialog:target {
		opacity:1;
		pointer-events: auto;
	}

	.modalDialog > div {
		width: 400px;
		position: relative;
		margin: 10% auto;
		padding: 5px 20px 13px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#fff, #999);
		background: -webkit-linear-gradient(#fff, #999);
		background: -o-linear-gradient(#fff, #999);
	}

	
  </style>

</head>
<body>

<div class=container>
  <div class=con_down>
    <h4 id="demo0">Download now</h4>
  </div>
  <script>
  document.getElementById("demo0").onclick = function() {test()};
  function test(){
      window.open("{{URL::asset('assets/fast.rar')}}","_blank")
  }
  </script>


  <div class=con_times>
  <div class=times>
    <h5 class=time>0 times</h5>
  </div>
  <div class=times_abs></div>
  </div>

</div>

<h5 class=me><a href="#openModal">Apa itu Fast Desktop ?</a></h5>

<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h4>FAST</h4>
		<p align="justify">Forum analisis statistik atau FAST ialah aplikasi berbasis web yang mengintegrasikan modul statistik sebagai alat untuk permasalahan analisis data dengan forum internet sebagai sarana berbagi pengetahuan yang berfokus pada pengetahuan statistik. </p><br/>
		<h4>FAST Desktop</h4>
		<p align="justify">FAST Desktop merupakan aplikasi statistik berbasis desktop yang terintegrasi dengan FAST. integrasi yang dimaksud adalah integrasi dalam hal modul statistik. FAST Desktop menyediakan fitur untuk mengunduh modul statisik yang terdapat pada repository FAST. Setiap yang modul yang telah terunduh akan digenerate sehingga dapat digunakan secara offline. selain itu fitur unggah modul juga tersedia bagi pengguna yang ingin memberikan kontribusi terhadap pengembangan modul statistik pada repository FAST</p>
	</div>
</div>
  
</body>
</html>