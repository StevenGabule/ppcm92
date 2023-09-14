$('body').append(`<section id="notifications-main"></section>`)
$("<style>")
  .prop("type", "text/css")
  .html(`
:root{
    --notify-bg-green-one: #def2d6;
    --notify-bg-green-two: #5A7052;
    
    --notify-bg-yellow-one: #f8f3d6;
    --notify-bg-yellow-two: #967132;

    --notify-bg-red-one: #ecc8c5;
    --notify-bg-red-two: #b32f2d;
    
    --notify-timeAnimation: 5s;
}

#notifications-main *{
    box-sizing: border-box;
}

#notifications-main{
    position: fixed;
    width: fit-content;
   /*  top: 0;
    left: 0; */
    display: flex;
    flex-direction: column;
    z-index: 999;
    user-select: none;
}

.notifications-box{
    width: fit-content;
    max-width: 450px;
    min-width: 400px;
    display: none;
    flex-direction: column;
    background: var(--notify-bg-green-one);
    color: var(--bg-text);
    border-radius: 4px;
    margin: 9px;
    
}
.notifications-box-one{
    width: 100%;
    display: flex;
    align-items: center;
    padding: 15px 12px;
    line-height: 1.8;
}

.notifications-box-icon{
    width: 22%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notifications-box-icon i{
    font-style: normal;
     font-size: 16px !important;
}

.notifications-box-two-animate{
    width: 0;
    height: 3px;
    border-radius: 0 0 0 10px;
    padding-left: 10px;
    /* background: var(--notify-bg-green-two); */
    animation: animationTimeBar var(--notify-timeAnimation) linear;
}


@keyframes animationTimeBar {

    0% {
        width: 100%;
    }
    100% {
        display: none;
        width: 0px;
    }

}

.notifications-box-msg{
    width: 100%;
    margin-left: 8px;
    display: flex;
    align-items: center;
}

.notifications-box-msg span{
   font-size: 16px !important;
    white-space: normal;
}

.notifications-box-close{
    width: 22%;
    display: flex;
    justify-content: right;
    align-items: center;
}

.notifications-box-close i{
    font-size: 16px !important;
    cursor: pointer;
    font-weight: bold;
    font-style: normal;
}

@media only screen and (max-width: 600px) {
    #notifications-main{
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    .notifications-box{
        /* min-width: 95%; */
        min-width: fit-content;
    }
    .notifications-box-one{
        /* flex-direction: column; */
    }
    .notifications-box-one span{
        text-align: center;
    }
    .notifications-box-close{
        justify-content: center;
    }
    .notifications-box-msg{
        justify-content: center;
    }
}
`)
  .appendTo("head")

function stringRandom(manhood) {
  let stringAleatory = '';
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  for (let i = 0; i < manhood; i++) {
    stringAleatory += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return stringAleatory;
}

function actionShowMsg(message,options,color,emoji=''){
  let notifications_main =  "#notifications-main";
  options.timeView = options.timeView === undefined ? 3000 : options.timeView < 4000 ? 4000 : options.timeView
  options.position = options.position === undefined ? ['top','right'] : options.position

  let randomCode = stringRandom(8);

  $(notifications_main).css({
    [options.position[0]]: '1%',
    [options.position[1]]: '1%',
  })

  $(notifications_main).append(`
    <div id="notifications-box-${randomCode}" class="notifications-box">
        <div class="notifications-box-one">
            <div class="notifications-box-icon">
                <i></i>
            </div>
            <div class="notifications-box-msg">
                <span id="notifications-box-msg-${randomCode}">${message}</span>
            </div>
            <div class="notifications-box-close">
                <i onclick="functionCloseMsg('${randomCode}')">X</i>
            </div>
        </div>
        <div class="notifications-box-two"><!-- animation --></div>
    </div>
    `)
  $(`#notifications-box-${randomCode}`)
    .fadeIn()
    .css(
      {
        'display':'flex',
        'background': color[0],
        'box-shadow': '0px 0px 20px 0px '+color[0]
      }
    )


  //definition o timer para o keyframe css
  $(':root').css({'--notify-timeAnimation':`${options.timeView / 1000}s`})
  const randomCodex = `#notifications-box-${randomCode}`;

  $(randomCodex).find(".notifications-box-two").addClass("notifications-box-two-animate")

  $(".notifications-box-two-animate").css({'background': color[1]})

  $(randomCodex).find('span').css({'color':color[1]})
  $(randomCodex).find('i').eq(0).css({'color':color[1]}).text(emoji)
  $(randomCodex).find('i').eq(1).css({'color':color[1]})
  $(randomCodex).find('a').css({'color':color[1]})

  //Time out
  setTimeout(() => {
    $(randomCodex).fadeOut()

    setTimeout(() => {

      $(randomCodex).remove()

      if(options.redirectAction != undefined){
        window.location.href = options.redirectAction
      }

    }, 500);
  }, options.timeView);

}

function functionCloseMsg(randomGet){
  $("#notifications-box-"+randomGet).fadeOut()

  setTimeout(() => {
    $("#notifications-box-"+randomGet).remove()
  }, 500);
}


$.notification = function(message, options){

  try {
    if(options.message, options.messageType === undefined){
      throw 'Error: Dado\'s silicosis necessarily fantasises!'
    }

    for (let i = 0; i < message.length; i++) {
      if(options.messageType === 'success'){
        let color = ['var(--notify-bg-green-one)','var(--notify-bg-green-two)']
        actionShowMsg(message[i],options,color)
      }else if(options.messageType === 'warning'){
        let color = ['var(--notify-bg-yellow-one)','var(--notify-bg-yellow-two)']
        actionShowMsg(message[i],options,color)
      }else if(options.messageType === 'error'){
        let color = ['var(--notify-bg-red-one)','var(--notify-bg-red-two)']
        actionShowMsg(message[i],options,color)
      }else{
        throw 'Error: MessageType invalid!'
      }
    }
  } catch (error) {
    console.log(error)
  }
}
