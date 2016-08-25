new Promise(resolve => {
  if (document.readyState === 'complete') {
    resolve();
  } else {
    window.onload = resolve;
  }
}).then(() => {
  return new Promise(function(resolve, reject) {
    VK.init({
      apiId: 5574212
    });

    VK.Auth.login(function(response) {
      if (response.session) {
        resolve(response);
      } else {
        reject(new Error('Не удалось авторизоваться'));
      }
    }, 2);
  });
}).then(() => {
  return new Promise( resolve => {
    VK.api('friends.get', {'fields': 'photo_50'}, function(response) {
      if (response.error) {
        reject(new Error(response.error.error_msg)); 
      } else {
        console.log(response.response);

        resolve();
      } 
    })
    // let source = document.getElementById('templateFriendsList').innerHTML;
    // let templateFn = Handlebars.compile(source);
    // let template = templateFn({list: });

    // mainList.innerHTML = template;
    // choosedList.innerHTML = template;

    
  })
});