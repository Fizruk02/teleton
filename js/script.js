var qw={
    qs:(e)=> {return qw.qsa(e)[0]},
    qsa:(e)=> {try {return document.querySelectorAll(e)} catch (v){return []} },
    doc:(e)=> {e=qw.obj(e); return e.contentDocument || e.contentWindow.document},
    obj:(e)=> {return (typeof(e)==="string"?qw.qs(e):e)},
    append:(e,t)=> {qw.qsa(e).forEach((e)=> {e.insertAdjacentHTML("beforeend", t)})},
    show(s){qw.d(s,"block")},
    hide(s){qw.d(s,"none")},
    d:(e, t)=> {let s;(s = qw.qs(e))&&(s.style.display = t)},
    event:(e, v, n)=>qw.lstnr(e, v, n),
    lstnr:(e, t, s)=> {qw.qsa(e).forEach((x)=> {x.addEventListener(t, s)})},
    click:(e, t)=> {qw.lstnr(e, "click", t)},
    post:(...a)=> { qw.ajax("POST",...a) },
    get:(...a)=> { qw.ajax("GET",...a) },
    ajax:(z, u, t, s, n, r=false)=> {
        var o,a,c=[],g=z==="GET";
        try {o = new ActiveXObject("Msxml2.XMLHTTP")} catch (e) {try {o = new ActiveXObject("Microsoft.XMLHTTP")} catch (e) {o = !1}}
        o || "undefined" == typeof XMLHttpRequest || (o = new XMLHttpRequest);
        for (let e in t) c.push(e + "=" + encodeURIComponent(typeof(t[e])==="object"?JSON.stringify(t[e]):t[e]));
        o.open(z, u+(g?(u.indexOf("?")>-1?"&":"?")+c.join("&"):""), 1), o.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), o.send(c.join("&")), o.onreadystatechange = function() {
            if (4 == o.readyState && 200 == o.status){
                if("json" === n)
                    try { a = JSON.parse(o.responseText); } catch(e) { a={err:e+"<hr><div>"+o.responseText+"</div>"}; }
                else a=o.responseText;
                if(r&&(a.err||!a.success)) return toast(r||"Error",a.err,"e");
                if(r&&a.warning) toast(r||"Warning",a.warning,"w");
                if(s) return s(a);
            }
        }
    },
}

var wgc = {
    msgNew:qw.qs(".message-new"),
    chatConnect:qw.qs(".chat-connect"),
    chatError:qw.qs(".chat-error"),
    command(command=false, type = "command", payload=false) {
        if(!socket.check()) return;
        
        socket.obj.send(JSON.stringify({
            type:type,
            mess:command,
            hash:user.hash,
            oper:user.oper,
            payload:payload,
        }));
    },
    notify(t) {
        wgc.command(t, "notify");
    },
    sendText(text=false, id=false) {
        if(!socket.check()) return;
        let  t = qw.qs(".bot-chat-text-send").innerText.replace("script","");
        if(text.length>0) t = text;
        if(id===false) id = 0;
        if(t.length>0) {
            qw.qs(".chat-box").innerHTML+=wgc.template(t);
            qw.qs(".bot-chat-text-send").innerHTML="<span></span>";
            socket.obj.send(JSON.stringify({
                type:"message",
                mess:t,
                hash:user.hash,
                oper: user.oper,
            }));
            wgc.scroll();
        }
    },
    incomingMessage:(t,f=false,type="")=> {
            qw.qs(".chat-box").innerHTML += wgc.templateAnswer(t,f,type);
            wgc.sound();
            if((el=qw.qs(".chat-section"))&&el.offsetLeft>document.body.offsetWidth) {
                wgc.msgNew.classList.add("show");
            }
            wgc.scroll();
    },
    textToComand: t=> {
        for (let a of (" "+t).matchAll(/\s[/]\w+/gm))
            t = (" "+t).replace(a[0], '<a href onclick="event.preventDefault();wgc.sendText(\'' + a[0].replace('/','!**#') + '\');">' + a[0].replace('/','!**#') + '</a>');
        return t.replaceAll('!**#','/');
    },
    errShow: t=>{
        wgc.chatError.innerHTML=t;
        wgc.chatError.classList.add("show");
        setTimeout(()=> { wgc.chatError.classList.remove("show"); }, 3000);
    },
    template: (t,f=false)=> {
        t=t.replace("\n", "<br />", "g")
        t = wgc.textToComand(t);
        return `<div class="bot-chat-msg right" style=""> <div class="bot-chat-text"><div class="chat-text">${t}</div></div></div>`;
    },
    templateAnswer: (t,f=false,type="")=> {
        t=t.replace("\n", "<br />", "g")
        t = wgc.textToComand(t);
        return `<div class="bot-chat-msg left" style=""> <div class="bot-chat-text"><div class="chat-text ${type}">${t}</div></div></div>`;
    },
    proccess:{
        status:false,
        event:()=> {
            wgc.notify("proccess");
        },
        display: t=> {
            if(!wgc.proccess.status){
                wgc.proccess.status=true;
                let it=qw.qs(".chat-process");
                it.innerHTML=t+" ????????????????..."
                it.style.display="block";
                setTimeout(()=> { it.style.display="none";wgc.proccess.status=false; }, 3000);
            }
        },
    },
    sound: ()=> {
        new Audio("/files/bell.mp3").play();
    },
    scroll:()=> {
        qw.qs(".chat-box").scroll({top: qw.qs(".chat-box").scrollHeight, left: 0, behavior: "smooth" });
    },
    connect:{
        online:n=>{
            wgc.chatConnect.classList.add("online");
            wgc.chatConnect.innerHTML=n+" online";
        },
        offline:n=>{
            wgc.chatConnect.classList.remove("online");
            wgc.chatConnect.innerHTML=n+" offline";
        },
    },
    session:{
        end:()=> {
            wgc.command("endSession");
        },
        resolved:st=> {
            wgc.command(st?"issueResolved":"issueNotResolved");
        },
    },
    form: {
        contacts: {
            start: ()=> {
                wgc.command("getContacts");
            },
            query: ()=> {
                //wgc.incomingMessage("?????????????? ???????????????? (????????)",false,"info");
                
                let h=`<div class="field_cart_fields_area">
                    <div class="fields_type_input data_fields" data-id="name" data-type="input" data-required="1">
                        <input class="fields_val" type="text" placeholder="?????????????? ??????">
                    </div>
                    
                    <div class="fields_type_input data_fields" data-id="phone" data-type="input" data-required="1">
                        <input class="fields_val" type="text" placeholder="?????????????? ??????????????">
                    </div>
                </div>`;
                
                qw.qs(".chat-box").innerHTML += h;
                
                qw.qs(".chat-box").innerHTML += `<div class="chat-system-inline">
                    <div class="inline__btn" onclick="wgc.form.contacts.send()">??????????????????</div>
                </div>`;
                
                wgc.scroll();
                
                
            },
            send:()=> {
                let p=[],s=1;
                document.querySelectorAll(".data_fields").forEach(function (it){
                    let v=it.querySelector(".fields_val").value.trim();
                    if(it.dataset.required==="1"&&v==="")it.classList.add("fields_empty"),s=false;else it.classList.remove("fields_empty");
                    p.push({
                        id:it.dataset.id,
                        val:v
                    });
                    
                })
                if(!s) return;
                wgc.command("sendFields", "command", p);
                console.log(p);
                
                //return s?p:false;
            }
        }

    },
}

var socket={
    obj:false,
    init:()=> {
        socket.obj = new WebSocket("wss://admin-testchat.host2bot.ru/ws/chat");
        socket.obj.onopen = socket.connection.open;
        socket.obj.onmessage = socket.messageReceived;
        socket.obj.onerror = socket.err;
    },
    check:()=> {
        if(socket.obj.readyState === WebSocket.CLOSED) {
            wgc.errShow("???????????? ?????????????????????? ?? ??????????????");
            //wgc.incomingMessage("???????????? ?????????????????????? ?? ??????????????",false,"danger");
            return false;
        }
        return true;
    },
    err: e=> {
        wgc.incomingMessage(e,false,"warning");
    },
    connection:{
        open:()=> {
            wgc.command("init");
        },
        close:()=> {
            socket.obj.close();
        },
    },
    messageReceived: e=> {
        let data = JSON.parse(e.data);
        if (data.type == "message") {
            wgc.incomingMessage(data.mess);
        } else if (data.type == "command") {
            switch (data.mess){
                case "init":
                    /*if (!data.oper) {
                        console.log("???? ???????????? ???????????? ?????? ?????????????????? ????????????");
                        qw.qs(".chat-box").innerHTML+=wgc.template("???? ???????????? ???????????? ?????? ?????????????????? ????????????");
                    }*/
                    break;
                case "endSession":
                    wgc.incomingMessage("?????????????????? ??????????????",false,"info");
                    break;
                case "getContacts":
                    wgc.incomingMessage("???????????????????? ?????????? ?????????????? ??????????????????",false,"info");
                    break;
                case "issueResolved":
                case "issueNotResolved":
                    qw.qsa(".chat-system-inline").forEach(it=>{ it.style.display="none" });
                    wgc.incomingMessage("?????????????? ???? ??????????",false,"success");
                    break;
                case "sendFields":
                    wgc.incomingMessage("???????????? ????????????????????",false,"success");
                    break;
                case "loadHistory":
                    let h="";
                    data.messages.forEach(it=>{
                        h+=it.my?wgc.template(it.message):wgc.templateAnswer(it.message);
                    });
                    qw.qs(".chat-box").innerHTML=h;
                    wgc.scroll();
                    break;
                    
                    
                    
                    
            }
        } else if(data.type==="notify") {
            switch (data.mess){
                case "proccess":
                    wgc.proccess.display(data.name);
                    break;
                case "connected":
                    wgc.connect.online(data.name);
                    break;
                case "disconnected":
                    wgc.connect.offline(data.name);
                    break;
                case "endSession":
                    wgc.incomingMessage(data.name+" ???????????? ??????????????????<br>?????????? ???? ?????? ?????????????",false,"info");
                    qw.qs(".chat-box").innerHTML += `<div class="chat-system-inline">
                        <div class="inline__btn" onclick="wgc.session.resolved(false)">??????</div>
                        <div class="inline__btn" onclick="wgc.session.resolved(true)">????</div>
                    </div>`;
                    wgc.scroll();
                    break;
                case "issueResolved":
                    wgc.incomingMessage("???????????????????????? ????????????????????, ?????? ???????????? ??????????",false,"success");
                    break;
                case "issueNotResolved":
                    wgc.incomingMessage("???????????????????????? ??????????????, ?????? ???????????? ???? ??????????",false,"warning");
                    break;
                case "getContacts":
                    wgc.form.contacts.query();
                    break;
                case "sendFields":
                    wgc.incomingMessage("<b>????????????????<b><br>"+
                    data.payload.map(it=>{return it.id+": "+it.val}).join("<br>") );
                    break;
                    
             
            }
        }

    },
}


document.addEventListener("DOMContentLoaded", function() {
    socket.init();
    qw.click(".chat-section .close", function () { qw.qs(".chat-section").style.right="-100%";  });

    qw.show(".feedback");
    qw.lstnr("[data-chwgtdshow]", "click", function (e) {
        wgc.msgNew.classList.remove("show");
       qw.qs(".chat-section").style.right="30px";
       //qw.qs("#chatBox").innerHTML="";
    });
    qw.lstnr(".bot-chat-text-send","input",function (e){
        wgc.proccess.event();
    })
    qw.click(".bot-btn", function (){
        wgc.sendText();
    });
    qw.lstnr(".bot-chat-text-send","keydown",function (e){
        if(e.keyCode === 13 && !e.shiftKey) {
            e.preventDefault();
            wgc.sendText();
        }
    })
    qw.lstnr(".bot-chat-text-send","keypress", function(e) {
        if (e.which == 13) {
            if (window.getSelection) {
                let selection = window.getSelection();
                let range = selection.getRangeAt(0);
                let zwsp = document.createTextNode("\u200B");
                range.insertNode(zwsp);
                range.setStartBefore(zwsp);
                range.setEndBefore(zwsp);
            }
        }
    });

});