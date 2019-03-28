function share(s){
	if(s==1){
		window.open('http://service.weibo.com/share/share.php?title=%E5%8F%AF%E8%83%BD%E6%98%AF%E4%BD%A0%E8%A7%81%E8%BF%87%E7%9A%84%E6%9C%80%E5%A5%BD%E7%9A%84%E7%94%B5%E8%84%91%E4%B8%BB%E9%A1%B5%20%23KIM%E4%B8%BB%E9%A1%B5%23%20%20&url=&pic=%2Ffront%2Fnav%2Fbgimg%2Fpreview%2F620#_loginLayer_1533699145827');
	}else if(s==2){
		window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?summary=&desc=&title=%E5%8F%AF%E8%83%BD%E6%98%AF%E4%BD%A0%E8%A7%81%E8%BF%87%E7%9A%84%E6%9C%80%E5%A5%BD%E7%9A%84%E7%94%B5%E8%84%91%E4%B8%BB%E9%A1%B5%20%23KIM%E4%B8%BB%E9%A1%B5%23&url=&pics=%2Ffront%2Fnav%2Fbgimg%2Fpreview%2F620&otype=share')
	}else if(s==3){
		$(".wechatshare").css('display','block');
	}else if(s==4){
		window.open('https://www.douban.com/share/service?href=&text=&name=%E5%8F%AF%E8%83%BD%E6%98%AF%E4%BD%A0%E8%A7%81%E8%BF%87%E7%9A%84%E6%9C%80%E5%A5%BD%E7%9A%84%E7%94%B5%E8%84%91%E4%B8%BB%E9%A1%B5%20%23KIM%E4%B8%BB%E9%A1%B5%23&title=%E5%8F%AF%E8%83%BD%E6%98%AF%E4%BD%A0%E8%A7%81%E8%BF%87%E7%9A%84%E6%9C%80%E5%A5%BD%E7%9A%84%E7%94%B5%E8%84%91%E4%B8%BB%E9%A1%B5%20%23KIM%E4%B8%BB%E9%A1%B5%23&image=%2Ffront%2Fnav%2Fbgimg%2Fpreview%2F620')
	}else if(s==5){
		window.open('https://www.linkedin.com/start/join?session_redirect=http%3A%2F%2Fwww.linkedin.com%2Fsharing%2Fshare-offsite%3Ftitle%3D%25E5%258F%25AF%25E8%2583%25BD%25E6%2598%25AF%25E4%25BD%25A0%25E8%25A7%2581%25E8%25BF%2587%25E7%259A%2584%25E6%259C%2580%25E5%25A5%25BD%25E7%259A%2584%25E7%2594%25B5%25E8%2584%2591%25E4%25B8%25BB%25E9%25A1%25B5%2520%2523KIM%25E4%25B8%25BB%25E9%25A1%25B5%2523%26url%3D%26summary%3D%26armin%3Darmin%26ro%3Dtrue%26mini%3Dtrue%26source%3D')
	}else if(s==6){
		window.open('https://www.facebook.com/sharer.php?u=&t=%E5%8F%AF%E8%83%BD%E6%98%AF%E4%BD%A0%E8%A7%81%E8%BF%87%E7%9A%84%E6%9C%80%E5%A5%BD%E7%9A%84%E7%94%B5%E8%84%91%E4%B8%BB%E9%A1%B5%20%23KIM%E4%B8%BB%E9%A1%B5%23')
	}else if(s==7){
		window.open('https://twitter.com/intent/tweet?text=可能是你见过的最好的电脑主页%20%23KIM主页%23%20%20&url=')
	}
	
}
$("#close").click(function(){
	$(".wechatshare").css('display','none');
})