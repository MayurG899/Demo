var visitor = {userID: "", name: "", email: "", picture: "", signedRequest: "", accessToken: ""};

function logIn(){

	$("#fb_error").hide("fast");

	FB.getLoginStatus(function(response){
		//console.log(response);
		if(response.status == "connected"){

			visitor.userID = response.authResponse.userID;
			visitor.accessToken = response.authResponse.accessToken;
			visitor.signedRequest = response.authResponse.signedRequest;

			FB.api("/me?fields=id,name,first_name,last_name,email,picture.type(large)",function(userData){
				//console.log("u-data-email" + userData.email);
				visitor.name = userData.name;
				visitor.email = userData.email;
				visitor.picture = userData.picture.data.url;

				$.ajax({
					url: site_root + "/admin/ajax/verify_facebook_login",
					method: "POST",
					data: visitor,
					dataType: "json",
					success: function(serverResponse){
						if(serverResponse.status == "success"){
							window.location = site_root + "/cp/dashboard";
						}else{
							$("#fb_status").html(serverResponse.status);
							$("#fb_message").html(serverResponse.message);
							$("#fb_error").show("fast");
							FB.logout(function(response){
								//document.cookie.split(";").forEach(function(c) {
								//	document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";domain=." + site_root + ";path=/");
								//});
							});
						}
					}
				});
			});
		}
	},{scope: "public_profile, email"});
};

window.fbAsyncInit = function() {
	var fb_app_id = $("#fb-app-id").attr("data-app-id");
	FB.init({
		appId            : fb_app_id,
		autoLogAppEvents : true,
		xfbml            : true,
		cookie           : true,
		version          : "v2.12"
	});
};

(function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "https://connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));

function checkLoginState(){
	logIn();
}