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
        let template;

        if (localStorage.leftFriendsBlock || localStorage.rightFriendsBlock) {
          if (localStorage.leftFriendsBlock) {
            let parseData = JSON.parse(localStorage.leftFriendsBlock);
            template = templateFn({list: parseData});
            mainList.innerHTML = template;
          } 
          if (localStorage.rightFriendsBlock) {
            let parseData = JSON.parse(localStorage.rightFriendsBlock);
            template = templateFn({list: parseData});
            choosedList.innerHTML = template;
            let ulChoosed = choosedList.children[0];
            ulChoosed.setAttribute('id', 'ulList2');
            console.log(ulChoosed);
          }
        } else {
          let template = templateFn({list: response.response});
          mainList.innerHTML = template;
        }
        resolve();
      } 
    })
  })
}).then(() => {
  return new Promise( resolve => {
    let activeElem, 
      parentNodeDiv,
      choosedElement,
      offsetX = 0,
      offsetY = 0;

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

    function pasteBlock(e) {
      let twoBlocksParent = e.target.closest('#friendsContainer');
      let checkParent = e.target.closest('[data-attr="list-container"]');

      if (checkParent !== parentNodeDiv && twoBlocksParent) {
        let parentForAppend = checkParent.querySelector('[data-type-list="append-list"]');
        let removeElem = choosedElement.removeChild(activeElem);
        parentForAppend.appendChild(removeElem);
      }
    }

    var mDown = function(e){
      choosedElement = e.target.closest('[data-type-list="append-list"]'); // ul в который складуем все liшки
      parentNodeDiv = e.target.closest('[data-attr="list-container"]'); // контеинер в котором текущий элемент
      activeElem = e.target.closest('[data-type="containerFriends"]'); // карточка друга
      
      if (choosedElement) {
        let spanAdd = activeElem.querySelector('.add-delete');
        if (e.target === spanAdd) {
          let checkUlContainer = document.querySelectorAll('[data-type-list="append-list"]');
          for ( let prop of checkUlContainer) {
            if (prop !== choosedElement) {
              let removeElem = choosedElement.removeChild(activeElem);
              prop.appendChild(removeElem);
            }
          }
        } else if (e.target !== spanAdd){
          offsetX = e.offsetX;
          offsetY = e.offsetY;
          activeElem.style.position = 'absolute';
          activeElem.style.width = 30 + '%';
          activeElem.style.zIndex = -10;
        }
      } 
    }

    var mUp = function(e){
      activeElem.style.position = 'static';
      activeElem.style.width = 100 + '%';  
      activeElem.style.zIndex = 10;
      pasteBlock(e);
        
      activeElem = null;
    }

    var mMove = function(e){
      activeElem.style.top = (e.clientY - offsetY) + 'px';
      activeElem.style.left = (e.clientX - offsetX) + 'px';
    }

    
    document.addEventListener('mousemove', mMove);
    friendsContainer.addEventListener('mousedown', mDown);
    document.addEventListener('mouseup', mUp);

    function saveFriends(e) {
      let saveLeftBlock = [],
        saveRightBlock = [],
        containerUlLeft = document.getElementById('ulList'),
        containerUlRight = document.getElementById('ulList2');

      function localStorageFunc(parentNode, arrForAppend) {  
        let arrChild = parentNode.children;
        for (let prop of arrChild) {
          let newObj = {},
          photoContainer = prop.querySelector('img'),
          urlPhoto = photoContainer.getAttribute('src'),
          nameForParse = prop.querySelector('[data-search="searchName"]').innerText.split(' '),
          firstName = nameForParse[0],
          lastName = nameForParse[1];
          
          newObj.photo_50 = urlPhoto;
          newObj.first_name = firstName;
          newObj.last_name = lastName;
          
          arrForAppend.push(newObj);
        }
        if (parentNode === ulList) {
          localStorage.leftFriendsBlock = JSON.stringify(arrForAppend);
        } else if (parentNode === ulList2) {
          localStorage.rightFriendsBlock = JSON.stringify(arrForAppend);
        }
      }

      localStorageFunc(containerUlLeft, saveLeftBlock);
      localStorageFunc(containerUlRight, saveRightBlock);
    }

    saveBtn.addEventListener('mousedown', saveFriends);

    function logoutFrindslist() {
      VK.Auth.logout( function() {
        if (confirm('Вы уверенны, что хотите выйти?')) {
          location.reload();    
        }
      })
    }

    closeWindow.addEventListener('mousedown', logoutFrindslist);
  })
});