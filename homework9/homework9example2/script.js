Handlebars.registerHelper('formatDate', function(time) {
  let currentDate = new Date(),
    bdayYear = time.split('.'),
    oldUser;
  if (bdayYear[2]){
    oldUser = currentDate.getFullYear() - bdayYear[2];
  } else {
    oldUser = 'не указан';
  }
  return oldUser;
});

new Promise(function(resolve) {
  if (document.readyState === 'complete') {
    resolve();
  } else {
    window.onload = resolve;
  }
}).then(function() {
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
}).then(function() {
  return new Promise(function(resolve, reject) {
    VK.api('users.get', {'name_case': 'gen'}, function(response) {
      if (response.error) {
        reject(new Error(response.error.error_msg));
      } else {
        headerInfo.textContent = `Фильтр по дате рождения на странице ${response.response[0].first_name} ${response.response[0].last_name}`;
        resolve();
      }
    });
  })
}).then(() => {
  return new Promise( resolve => {
    VK.api('friends.get', {'fields': 'photo_100,bdate'}, function(response) {
      if (response.error) {
        reject(new Error(response.error.error_msg));
      } else {
        let beforeDate = [],
          afterDate = [],
          nowDate = new Date(),
          parseDate = (nowDate.getMonth() + 1) * 100 + nowDate.getDate();

        for (var obj of response.response){
          if (obj.bdate){
            let dayMonth = obj.bdate.split('.'),
              parseBday = parseInt(dayMonth[1]) * 100 + parseInt(dayMonth[0]);

            if (parseBday >= parseDate) {
              afterDate.push(obj);
            } else {
              beforeDate.push(obj);
            } 
          }
        }

        function sortUser(a, b){
          let dateA = a.bdate.split('.'),
            parseA = parseInt(dateA[1]) * 100 + parseInt(dateA[0]);   
            dateB = b.bdate.split('.'),
            parseB = parseInt(dateB[1]) * 100 + parseInt(dateB[0]);   
          return parseA - parseB;
        }
        
        beforeDate.sort(sortUser);
        afterDate.sort(sortUser);

        let fullList = afterDate.concat(beforeDate);

        let source = document.getElementById('friendsItemTemplate').innerHTML;
        let templateFn = Handlebars.compile(source);
        let template = templateFn({list: fullList});

        results.innerHTML = template;

        resolve();
      }
    });
  })
}).catch(function(e) {
  alert(`Ошибка: ${e.message}`);
});

