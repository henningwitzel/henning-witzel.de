<title>Capturing User Feedback – One thing people do when an app doesn’t seem to work · Henning Witzel</title>
<meta property="og:title" content="Capturing User Feedback – One thing people do when an app doesn’t seem to work · Henning Witzel" />
<meta name="twitter:title" content="Capturing User Feedback – One thing people do when an app doesn’t seem to work · Henning Witzel" />

<meta name="description" content="Do you struggle to know what is going on when something went wrong within your app? Do you get..." />
<meta property="og:description" content="Do you struggle to know what is going on when something went wrong within your app? Do you get..." />
<meta name="twitter:description" content="Do you struggle to know what is going on when something went wrong within your app? Do you get..." />

<meta property="og:image" content="###basepath###img/header/user-feedback.png" />
<meta name="twitter:image" content="###basepath###img/header/user-feedback.png" />

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@henning_witzel" />
</head>
  <body basepath='###basepath###'></body>
  <div id='clearbutton'></div>
</html>
<div class='image' 
data_image_1280='###basepath###img/header/feedback-header-1280.jpg' 
data_image_1440='###basepath###img/header/feedback-header-1440.jpg' 
data_image_1920='###basepath###img/header/feedback-header-1920.jpg' 
data_image_800='###basepath###img/header/feedback-header-800.jpg' id='header'></div>
<div class='text' id='background'>
  <div id='wrapper'>
    <div id='logo'>
      <a href='###basepath###'>
        <div id='link'></div>
      </a>
    </div>
     ###menu###
    <div class='content'>          
      <h1>Capturing User Feedback – One thing people do when an app doesn’t seem to work</h1>
      <h4 class="grey bottom-large">August 2nd, 2020 · 5 min read</h4>
      <p>Do you struggle to know what is going on when something went wrong within your app? Do you get feedback from your users about an issue, but it's hard to figure out what happened exactly? I'm not talking about crashes – more like a white screen, getting stuck, or something did not load.</p>
      <p>If you can answer one of these with yes, I might have something interesting for you. In this article, I share the learnings on how we managed to develop an effective way of capturing user feedback when something went wrong.</p>
      <p>For the past three years, I've been <a href="https://www.henning-witzel.de/portfolio">working on an mPOS app</a> used by thousands of store associates at Decathlon, Burton or UNTUCKit. Regularly we received feedback that they had some issues during the day. The usual process for them was to tell one of their store managers that something didn't work. She would then send our support team an email with some details about what happened. The team would follow up to learn more about it. Often we needed to communicate back and forth with the customer to help us reproduce the issue. Sometimes the customer made recordings or screenshots that helped a lot.</p>

      <p>This process had many issues, and below there is a list of problems we identified:</p>
      <ul>
      <li>Problems occur at different frequencies but do not get reported immediately. The associate has to talk to someone to be able to give the support team feedback.</li>
      <li>There is no exact reference point for the support team.</li>
      <li>Often there are no logs from the client (something that happened on associates' phone).</li>
      <li>Unnecessary interaction with additional people.</li>
      <li>Due to missing technical details, the cause of the problem is often more based on assumptions.</li>
      <li>A lot of conversation in the Jira-ticket to get all the details of what happened.</li>
      </ul>
      <p class="bottom-large">Obviously, it's not a very effective way. A lot of investment in time and communication is needed, even identifying the issue. With this circumstance and result mind, we wanted to improve the user experience and change the outcome.</p>
      
      <h3 class="bottom-small">How can we make this better?</h3>

      <p>First, we set our <a href="https://basecamp.com/shapeup/1.2-chapter-03#setting-the-appetite" target="_blank">appetite</a>. We were looking for a solution that can be designed and developed within a sprint or two (2-4 weeks). With this time constraint, we came up with the idea of allowing associates to send us feedback directly through the app. The following user story was added to our backlog.</p>

      <p><i>As an associate, I want to send NewStore feedback when I have an issue with the app to let them know what happened without involving someone else.</i></p>

      <p>We scoped the work into two parts: First, come up with a user flow to capture the feedback, and second find a place to store it and make it available for support. The user flow we designed provided two ways to tell us what happened – a <i>Report an Issue</i> button and <i>Shake to Report</i>. For storing the feedback, the engineers suggested using <a href="https://sentry.io/">Sentry</a> to track the issue since it was already in place to identify crashes. At this point, both options for the user flow sounded like a good idea to me. Whenever something doesn't work, they would shake the phone and tell us.</p>

      <a class="image-link" href="###basepath###pages/blog/feedback/images/report-an-issue.png"><img  src="###basepath###pages/blog/feedback/images/report-an-issue.png" /></a>
      <div class="video-description grey bottom-large">The initial user flow I designed in Sketch.</div>

      <p>This first internal version did not make us happy. The shaking and the report button required some training, and after having the developed version in our hands, we realized how sensitive the phone reacts to shaking. Often the dialog would appear to report an issue, but there was no problem. That can be pretty annoying. Mhhh... how can we make it better?</p>
      
      <p class="bottom-large">While trying to figure that out, we could already store the feedback in Sentry. Every report provides a broad set of information to understand what has happened, such as a breadcrumb with the UI interactions or data that got sent to the back end. Additionally, some metadata like the phone model, iOS version, and app version. In the two screenshots below you can see an overview of feedback reports and an example.</p>

      <a class="image-link" href="###basepath###pages/blog/feedback/images/sentry_overview.png"><img  src="###basepath###pages/blog/feedback/images/sentry_overview.png" /></a>
      <div class="video-description grey bottom-large">Overview of feedback reports</div>

      <a class="image-link" href="###basepath###pages/blog/feedback/images/sentry.png"><img  src="###basepath###pages/blog/feedback/images/sentry.png" /></a>
      <div class="video-description grey bottom-large">A detailed report with user interactions</div>
      
      <p class="bottom-large">An engineer in the team suggested using the new form also for crashes to provide more insights – I liked the idea! That addition required a change in the user flow since we wanted to ask the user first with a prompt if she even wants to provide feedback. Improving this helped us to find a better way of capturing the user's feedback.</p>

      <h3 class="bottom-small">Ask for feedback when an app gets closed and reopened.</h3>

      <p>When you observe users what they do when an app has a problem, you can recognize a typical behavior: "<i>It looks like the app has a problem. Let me quickly close and reopen it.</i>"</p>

      <p>This is it 🤩</p>
      
      <p>When the associate is closing the app and immediately reopens, we assume there was an issue, and ask for feedback. The idea for this came from an engineer on the team. After making sure this is actually feasible with iOS, we moved on with the implementation.</p>

      <p>The image below shows you the final user flow we ended up shipping.</p>

      <a class="image-link" href="###basepath###pages/blog/feedback/images/userflow.jpg"><img  src="###basepath###pages/blog/feedback/images/userflow.jpg" /></a>

      <p>In addition, I added a little video where I'm browsing the catalog and recognize that there are no items in the release category. Let's assume this is not how it should be and restart the app.</p>

      <video width="300" height="650" poster="###basepath###pages/blog/feedback/images/placeholder.jpeg" controls class="block">
          <source src="###basepath###pages/blog/feedback/videos/user-feedback.mp4" type="video/mp4">          
        Your browser does not support the video tag.
      </video>
      <div class="video-description grey">Recording of our Associate App</div>

      <p>This way of capturing the feedback turned out to be quite useful, and we could observe the following results:</p>
      <ul>
        <li>Problems get reported immediately</li>
        <li>There are exact reference points, logs and technical details available for the support team</li>
        <li>No additional interaction with other people required</li>
        <li>We reduced the time to investigate on the customers and support side</li>
      </ul>

      <p>On the flip side, we see a lot of messages coming that need more clarification. For example, "<i>white screen</i>", "<i>not connecting</i>" or similar. We believe that improving the form by guiding the associate when describing the problem will result in more insightful reports.</p>

      <p>Besides helping our mobile app team and support with this, it also helps me as a designer. Every Monday morning, I'm checking the latest feedback that came in, categorize it, and try to understand our user's behavior. Where do we see the most issues, where does it make sense to follow up, and so on.</p>

      
      <p class="bottom-medium">I hope you enjoyed my little story and there was something that you can take away from it. If you have questions or feedback, feel free to send an email to  <a href="mailto:witzel@hey.com">witzel@hey.com</a> – happy to hear from you.</p>
      
      <h3 class="bottom-small">Interested in more?</h3> 
      <p>Follow me on <a href="https://twitter.com/henning_witzel/">Twitter</a> if you are interested in my experiences about UX design and product management.</p>

      <p>Cheers Henning 👋</p>
      </div>
    <div class='clearfix'></div>
  </div>
</div>
