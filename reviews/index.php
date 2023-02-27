
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Telegram Widget</title>
    <base target="_blank">
    <script>document.cookie="stel_dt="+encodeURIComponent((new Date).getTimezoneOffset())+";path=/;max-age=31536000;samesite=None;secure"</script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="MobileOptimized" content="176" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="robots" content="noindex, nofollow" />
    
    <link rel="icon" type="image/svg+xml" href="//telegram.org/img/website_icon.svg?4">
<link rel="apple-touch-icon" sizes="180x180" href="//telegram.org/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="//telegram.org/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="//telegram.org/img/favicon-16x16.png">
<link rel="alternate icon" href="//telegram.org/img/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet" type="text/css">
    <link href="//telegram.org/css/widget-frame.css?62" rel="stylesheet" media="screen">
    <link href="//telegram.org/css/discussion-widget.css?12" rel="stylesheet">

    <style>
body.body_widget_discussion {
  --accent-color: #343638;
  --accent-line-color: #343638;
  --accent-btn-color: #343638;
  --accent-btn-bghover: rgba(52,54,56,0.1);
  --accent-btn-bgactive: rgba(52,54,56,0.1);
  --voice-progress-bgcolor: rgba(52,54,56,0.25);
  --verified-icon-svg: url('data:image/svg+xml,%3Csvg%20height%3D%2226%22%20viewBox%3D%220%200%2026%2026%22%20width%3D%2226%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22m14.378741%201.509638%201.818245%201.818557c.365651.365716.861601.571194%201.378741.571259l2.574273.000312c1.01361.000117%201.846494.773578%201.940861%201.762436l.008905.187798-.000312%202.5727c-.000065.517322.205439%201.013454.571259%201.379222l1.819649%201.819337c.714441.713427.759174%201.843179.134563%202.609139l-.134797.148109-1.819181%201.8182502c-.365963.3657823-.571558.8620196-.571493%201.3794456l.000312%202.5737972c.000559%201.0136048-.772668%201.846676-1.7615%201.9412861l-.188266.0084786-2.573792-.0003107c-.517426-.0000624-1.013675.2055248-1.379456.5714956l-1.818245%201.8191823c-.71331.7145515-1.843049.7594886-2.609113.1349998l-.148135-.1347645-1.8193435-1.8196542c-.3657628-.3658252-.8618987-.5713214-1.3792103-.571259l-2.5727052.0003107c-1.0136048.0001222-1.846676-.7731321-1.9412861-1.761968l-.0089492-.1877967-.0003107-2.5742678c-.0000624-.5171478-.2055495-1.0130926-.571259-1.3787397l-1.8185622-1.8182515c-.7139886-.713869-.758706-1.843647-.1340846-2.609607l.1338493-.148109%201.8190328-1.81935c.3655665-.365625.5709613-.861471.5710237-1.378494l.0003107-2.573181c.0006006-1.076777.8734635-1.949636%201.9502353-1.950234l2.5731758-.000312c.5170321-.000065%201.0128768-.205452%201.3785044-.571025l1.8193448-1.819038c.761592-.761449%201.996254-.761345%202.757716.000247zm3.195309%208.047806c-.426556-.34125-1.032655-.306293-1.417455.060333l-.099151.108173-4.448444%205.55815-1.7460313-1.74707-.1104961-.096564c-.4229264-.32188-1.0291801-.289692-1.4154413.096564-.3862612.386269-.4184492.992511-.0965653%201.41544l.0965653.1105%202.5999987%202.5999987.109876.0961467c.419874.320359%201.015131.2873897%201.397071-.0773773l.098579-.107692%205.2-6.4999961.083772-.120484c.273208-.455884.174278-1.054885-.252278-1.396122z%22%20fill%3D%22%23343638%22%20fill-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E');
  --radio-item-color: #343638;
  --radio-ripple-color: rgba(52,54,56,0.2);
}
 .accent_bg,
 .accent_bghover {
  background-color: #343638 !important;
  color: var(--light-btn-text);
}
 .accent_bghover:hover,
 .accent_bghover:focus {
  background-color: #313335 !important;
  color: var(--light-btn-text);
}
body.dark.body_widget_discussion {
  --accent-color: #ffffff;
  --accent-line-color: #ffffff;
  --accent-btn-color: #ffffff;
  --accent-btn-bghover: rgba(255,255,255,0.1);
  --accent-btn-bgactive: rgba(255,255,255,0.1);
  --voice-progress-bgcolor: rgba(255,255,255,0.25);
  --verified-icon-svg: url('data:image/svg+xml,%3Csvg%20height%3D%2226%22%20viewBox%3D%220%200%2026%2026%22%20width%3D%2226%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22m14.378741%201.509638%201.818245%201.818557c.365651.365716.861601.571194%201.378741.571259l2.574273.000312c1.01361.000117%201.846494.773578%201.940861%201.762436l.008905.187798-.000312%202.5727c-.000065.517322.205439%201.013454.571259%201.379222l1.819649%201.819337c.714441.713427.759174%201.843179.134563%202.609139l-.134797.148109-1.819181%201.8182502c-.365963.3657823-.571558.8620196-.571493%201.3794456l.000312%202.5737972c.000559%201.0136048-.772668%201.846676-1.7615%201.9412861l-.188266.0084786-2.573792-.0003107c-.517426-.0000624-1.013675.2055248-1.379456.5714956l-1.818245%201.8191823c-.71331.7145515-1.843049.7594886-2.609113.1349998l-.148135-.1347645-1.8193435-1.8196542c-.3657628-.3658252-.8618987-.5713214-1.3792103-.571259l-2.5727052.0003107c-1.0136048.0001222-1.846676-.7731321-1.9412861-1.761968l-.0089492-.1877967-.0003107-2.5742678c-.0000624-.5171478-.2055495-1.0130926-.571259-1.3787397l-1.8185622-1.8182515c-.7139886-.713869-.758706-1.843647-.1340846-2.609607l.1338493-.148109%201.8190328-1.81935c.3655665-.365625.5709613-.861471.5710237-1.378494l.0003107-2.573181c.0006006-1.076777.8734635-1.949636%201.9502353-1.950234l2.5731758-.000312c.5170321-.000065%201.0128768-.205452%201.3785044-.571025l1.8193448-1.819038c.761592-.761449%201.996254-.761345%202.757716.000247zm3.195309%208.047806c-.426556-.34125-1.032655-.306293-1.417455.060333l-.099151.108173-4.448444%205.55815-1.7460313-1.74707-.1104961-.096564c-.4229264-.32188-1.0291801-.289692-1.4154413.096564-.3862612.386269-.4184492.992511-.0965653%201.41544l.0965653.1105%202.5999987%202.5999987.109876.0961467c.419874.320359%201.015131.2873897%201.397071-.0773773l.098579-.107692%205.2-6.4999961.083772-.120484c.273208-.455884.174278-1.054885-.252278-1.396122z%22%20fill%3D%22%23ffffff%22%20fill-rule%3D%22evenodd%22%2F%3E%3C%2Fsvg%3E');
  --radio-item-color: #ffffff;
  --radio-ripple-color: rgba(255,255,255,0.2);
}
body.dark .accent_bg,
body.dark .accent_bghover {
  background-color: #ffffff !important;
  color: var(--light-btn-text);
}
body.dark .accent_bghover:hover,
body.dark .accent_bghover:focus {
  background-color: #f2f2f2 !important;
  color: var(--light-btn-text);
}</style>
    <script>TBaseUrl='//telegram.org/';</script>
  </head>
  <body class="widget_frame_base tgme_widget body_widget_discussion emoji_image force_userpic nodark name_nocolor dark_accent_light">
    
<div class="tgme_post_discussion_header_wrap">
  <a class="tgme_widget_message_bubble_logo" href="//core.telegram.org/widgets" target="_blank"></a>
  <h3 class="tgme_post_discussion_header"><span class="js-header">44 comments</span> on <a href="https://t.me/otzaviksait/2">this post</a></h3>
</div>
<div class="tgme_post_discussion js-message_history">
  <div class="tme_messages_more accent_bghover js-messages_more" data-before="58">Show 39 more comments</div>
  
  
  
  
<div class="tgme_widget_message_wrap js-widget_message_wrap">
   <div class="tgme_widget_message text_not_supported_wrap js-widget_message" data-peer="c1760760720_-4765483067351133987" data-peer-hash="09611dba39d960a6ca" data-post-id="58">
      <div class="tgme_widget_message_user">
          <i class="tgme_widget_message_user_photo bgcolor0" data-content="П">
              <img src="https://cdn4.telegram-cdn.org/file/ALfQEtbvtOKy5NvRDKe9K_ap8XyJ6yfo1e4npaEsjvB2eeloE-wb4wNVDd7QNvPX5wmvGx9jZ0cVjV6UQSfHiB6Htr2QsrUFdR7GZchPy-0WNEN22kzSHMsDLJ6NbkZh7hjeifNVnOT9GRsDl3YPLvpf-7fEEhBqQ_391OgyHVv-L2sW1NIlJs-pqaMytVYu0TMgXyyNgZhucoV9P0zlRXYGZ2UiBSwOo26jxeOIvNXFCsopsJgivnwsQ3KRG83HK5ViImZJny4Z7Dk61lYNISE8uoYEL1l29ujnrRizObvQyrCIrDs47O2nRHCuia_QGSx3aSfKXfIkwbSn06Enyw.jpg">
          </i>
      </div>
      <div class="tgme_widget_message_bubble">
         <div class="tgme_widget_message_author accent_color">
             <span class="tgme_widget_message_author_name">
                 <span dir="auto" class="name color0">Павлик Павлик</span>
             </span>
         </div>
         <div class="tgme_widget_message_reply_template js-reply_tpl">

            <div class="tgme_widget_message_author accent_color">
               <span class="tgme_widget_message_author_name" dir="auto">Павлик Павлик</span>
            </div>
            <div class="tgme_widget_message_text js-message_reply_text" dir="auto">Огромное спасибо парням&#33; Всё в лучшем виде, отправил деньги через 5 минут заявка в ги и всё на своих местах&#33;&#33;&#33; ))</div>
         </div>
         <div class="tgme_widget_message_text js-message_text" dir="auto">Огромное спасибо парням&#33; Всё в лучшем виде, отправил деньги через 5 минут заявка в ги и всё на своих местах&#33;&#33;&#33; ))</div>
         <div class="tgme_widget_message_footer js-message_footer">
            <a class="tgme_widget_message_date" href="https://t.me/otzaviksait/2?comment=58"><time datetime="2022-08-11T06:36:00+00:00">Aug 11</time></a>
         </div>
      </div>
   </div>
</div>


















<div class="tme_messages_more accent_bghover js-messages_more autoload hide" data-after="68"></div>
</div>
<!--   <div class="tgme_post_discussion_footer">
  <form class="tgme_post_discussion_new_message_form js-new_message_form">
    <input type="hidden" name="peer" value="c1760760720_-4765483067351133987" />
    <input type="hidden" name="top_msg_id" value="2" />
    <input type="hidden" name="discussion_hash" value="e65bc194a6dedd8da9" />
  </form>
    <div class="tgme_post_discussion_login">
  <div class="tgme_post_discussion_login_btn accent_bghover js-login_btn">Log in to comment</div>
</div>
</div> -->

  </body>
</html>
<!-- page generated in 77.78ms -->
