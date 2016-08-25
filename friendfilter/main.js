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
        let source = document.getElementById('templateFriendsList').innerHTML;
        let templateFn = Handlebars.compile(source);
        let template = templateFn({list: response.response});

        mainList.innerHTML = template;
        // choosedList.innerHTML = template;
        resolve();
      } 
    })
  })
}).then(() => {
  return new Promise( resolve => {
    
    function searchFunc(parentNode, inputNode) {
      let friendsList = parentNode.children[0].children, 
          inputValue = inputNode.value.toLowerCase();  
        
      for(let propLi of friendsList){
        let nameFriend = propLi.querySelector('[data-search="searchName"]'),
          innerLiText = propLi.innerText.toLowerCase(),
          indexFriend = innerLiText.indexOf(inputValue);
        if (indexFriend < 0){
          propLi.style.display = 'none';
        } else {
          propLi.style.display = 'block';
        }
      }
    };  
    
    mainInput.addEventListener('keyup', e => {
      searchFunc(mainList, e.target);
    });

    choosedInput.addEventListener('keyup', e => {
      searchFunc(choosedList, e.target);
    });
  })
});