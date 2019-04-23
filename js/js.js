var DEBUG = true;
DEBUG || window.console.log("%cHold on!", "font-weight: bold; font-style: sans-serif; color: #EF5350; text-shadow: 3px 3px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; font-size: 30px;")
DEBUG || window.console.warn("%cThis is intended for developers, if you were told to post something here there is a good chance someone may be attempting to comprimise your account. ","font-weight: bold; font-size: 14px");

if(!DEBUG)window.console.log = function(){};

var options = {
  toast: {
    defaultTimeout: 5000,
    fadeTime: 100
  }
}
var load;

//Requests
var requests = {
  login: function() {
    let data = {
      email: $("#email").val(),
      password: $("#password").val()
    }
    api(0, data, function(r) {
      goto("Dashboard");
    });
  },
  logout: function() {
    api(1, null, function() {
      goto("");
    });
  },
  seeNotification: function(nid) {
    let data = {
      notification: nid
    }
    api(7, data, function() {
      toast.success("Marked "+(nid==-1?"all ":"")+"as seen");
    });
  },
  loadNotifications: function() {
    api(8, null, function (r) {
      $("#notificationSpace").html(r);
    }, true);
  }
};

function api(goal, data, success, ignoreFail) {
  data = data || {};
  success = success || function(){};
  data["g"] = goal;
  ignoreFail = ignoreFail || false;
  console.log(goal, data)
  $.ajax({
    url: "api/interface.php",
    cache: false,
    data: data,
    method: "POST",
    success: function(r) {
      if(ignoreFail)
        return success(r);
      if(r == "SUCCESS")
        success(r);
      else
        handleMessage(goal, r);
    }
  })
}

function handleMessage(g, r) {
  if(r == "ALREADY")
    return toast.error("You are already logged in", "You must not be logged in to preform this action");

  toast.error("An unknown error occured!", DEBUG?r:"Please <a href=\"Bug\">report this</a> to us." , {timeout: -1});
}

var toast = {
  toast: function(type, title, description, timeout, dismissable) {

    let icon = $("#icon_repo_"+type).html() || "";
    let toast = $("<div></div>", {class: "toast "+type+" "+(dismissable?"dismissable":"")}).hide();
      toast.append($("<div></div>", {class: "icon"}).html(icon));
      if(title)
        toast.append($("<div></div>", {class: "description"}).append(
          $("<div></div>", {class: "title" + (description?"":" full")}).html(title)
        ));
      if(description)
        toast.find(".description").append(
          $("<div></div>", {class: "description" + (title?"":" full")}).html(description)
        );
      toast.click(function(e) {
        if(e.ctrlKey)
          $(".toast").fadeOut(options.toast.fadeTime, function() {
            $(".toast").remove();
          });
        else
          $(this).fadeOut(options.toast.fadeTime, function() {
            $(this).remove();
          });
      });
      console.log(toast);
      dismissable && toast.append($("<div></div>", {class: "dismiss"}).html($("#icon_repo_close").html()));
    $("#toasts").append(toast.fadeIn(options.toast.fadeTime));
    timeout != -1 && setTimeout(function() {
      toast = toast || $();
      toast.fadeOut(options.toast.fadeTime, function() {
        $(this).remove();
      });
    }, timeout||options.toast.defaultTimeout);
  },
  success: function(title, description, options) {
    var options = options || {};
    let timeout = options["timeout"];
    let dismissable = options["dismissable"] == undefined?true:options["dismissable"];
    console.log(options)
    console.log(dismissable)
    toast.toast("success", title, description, timeout, dismissable);
  },
  warning: function(title, description, options) {
    var options = options || {};
    let timeout = options["timeout"];
    let dismissable = options["dismissable"] == undefined?true:options["dismissable"];
    console.log(options)
    console.log(dismissable)
    toast.toast("warning", title, description, timeout, dismissable);
  },
  error: function(title, description, options) {
    var options = options || {};
    let timeout = options["timeout"];
    let dismissable = options["dismissable"] == undefined?true:options["dismissable"];
    console.log(options["dismissable"])
    console.log(dismissable)
    toast.toast("error", title, description, timeout, dismissable);
  }
}

function goto(goal) {
  console.log(goal);
  window.location.href = BASE+'/'+goal;
}

// UI & UX
$(".item").click(function(e) {
  var t = $(this);
  console.log($(this))
  $(".item.show").filter(function(){return !$(this).is(t)}).removeClass("show");
  if(!$(e.target).parents(".dropdown").length)
    $(this).toggleClass("show");
})
$("html").click(function(e) {
  if(!$(e.target).parents(".item").length && !$(e.target).is(".item"))
    $(".item.show").removeClass("show");
})

$(".hyperlink:not([external])").click(function(e) {
  e.preventDefault();
  var href = $(this).attr("href");
  if(href.charAt(0) == "#")
    return;
  switch (href) {
    case "logout":
      requests.logout();
      break;
    case "language":
      Cookies.set("language", $(this).attr("language"));
      location.reload();
      break;
    default:
      goto(href);
      break;
  }
})
$("body").on("click", ".bar .action svg.fa-times", function(e) {
  if(e.ctrlKey)
    requests.seeNotification(-1)
  else if($(this).parents(".bar[notification-id]").length)
    requests.seeNotification($(this).parents(".bar[notification-id]").attr("notification-id"));
  var t = $(this);
  setTimeout(function() {
    if(e.ctrlKey)
      t.parents(".bars").find(".bar").fadeOut(function() {$(this).remove();requests.loadNotifications()});
    t.parents(".bar").fadeOut(function() {$(this).remove();requests.loadNotifications()});
  }, 1);
});
requests.loadNotifications();
