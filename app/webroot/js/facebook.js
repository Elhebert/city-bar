window.fbAsyncInit = function() {
  FB.init({
    appId      : '1458128141086340',
    status     : true,
    cookie     : true,
    xfbml      : true,
    oauth      : true
  });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/fr_FR/all.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

jQuery(function($){
  $('.facebookConnect').click(function(){
    var url = $(this).attr('href');
    FB.login(function(response){
      if(response.authResponse){
        window.location = url;
      }
    },{scope : 'basic_info'});
    return false;
  });
});