<style>

@import url(https://fonts.googleapis.com/css?family=Open+Sans:700,400);
.particles-js-canvas-el {
	position: fixed;
}
.container {
	background-color: transparent !important;
}
.carousel {
	 position: relative;
	 width: 100%;
	 font-size: 50px;
	 line-height: 75px;
	 height: 75px;
}
 .carousel .pre {
	 top: 0;
	 height: 75px;
	 text-shadow: 2px 2px 2px #ffc107;
}
 .carousel .change_outer {
 	color: #285c4d;
	 top: 0;
	 left: 51%;
	 height: 75px;
	 overflow: hidden;
}
 .carousel .change_outer .change_inner {
	 position: relative;
	 animation: rotate 8s ease-in-out infinite;
}
 .carousel .change_outer .element {
	 display: block;
	 font-weight: 700;
	 text-shadow: 2px 2px 2px #ffc107;
}
.loading {
    background: rgba(255, 255, 255, 0.6) url('{{ asset('public/img/load.gif')}}') no-repeat center;
    position:fixed;
    width:100%;
    height:100%;
    top:0px;
    left:0px;
    z-index:999999999;
    display: none;
}
.float{
      position:fixed;
      width:60px;
      height:60px;
      bottom:25px;
      right:40px;
      background-color:#0C9;
      color:#FFF;
      border-radius:50px;
      text-align:center;
      box-shadow: 2px 2px 3px #999;
      border: none;
    }
/* @keyframes rotate {
	 0%, 20% {
		 transform: translateY(0);
	}
	 25%, 45% {
		 transform: translateY(-75px);
	}
	 50%, 70% {
		 transform: translateY(-150px);
	}
	 75%, 95% {
		 transform: translateY(-225px);
	}
	 100% {
		 transform: translateY(-300px);
	}
}*/
 
</style>