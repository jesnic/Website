var DEBUG = true;
DEBUG || window.console.log("%cHold on!", "font-weight: bold; font-style: sans-serif; color: #EF5350; text-shadow: 3px 3px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; font-size: 30px;")
DEBUG || window.console.log("%cThis is intended for developers,\nif you were told to post something\nhere there is a good chance someone\nmay be attempting to comprimise your\naccount. ","font-style: sans-serif; color: #EF5350; font-weight: bold; font-size: 16px;text-shadow: 3px 3px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;");

if(!DEBUG)window.console.log = function(){};
if(!DEBUG)window.console.warn = function(){};
if(!DEBUG)window.console.error = function(){};

var options = {
  toast: {
    defaultTimeout: 5000,
    fadeTime: 100
  },
  icons: {
    autoload: ["success", "error", "close"]
  }
}
function api(goal, data, success, ignoreFail, async) {
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
function goto(goal) {
  console.log(goal);
  window.location.href = BASE+'/'+goal;
}
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
var toast = {
  toast: function(type, title, description, timeout, dismissable) {
    let icon = icons.get(type);
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
var icons = {
  repo: {},
  loading: true,
  get: function(icon) {
    if(icons.repo[icon])
      return icons.repo[icon];
    api(11, {icon: icon}, function(i) {
      icons.repo[icon] = i;
      console.error("An icon ("+icon+") had to be loaded! Perhaps was it still autoload");
      return "LOADING";
    }, true);
  },
  autoload: function() {
    $.each(options.icons.autoload, function(index, i) {
      console.log("Loading icon ("+i+")")
      icons.get(i);
    })
    icons.autoload = undefined;
  }
}

icons.autoload();
requests.loadNotifications();

// https://stackoverflow.com/questions/13470898/keep-uppercase-using-attr-with-jquery-case-sensitive/22335908
$.attrHooks['viewbox'] = {
    set: function(elem, value, name) {
        elem.setAttributeNS(null, 'viewBox', value + '');
        return value;
    }
};

// Event junk
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
$(".tree li>a").click(function() {
  let sib = $(this).siblings("ul");
  if($(this).hasClass("active")) {
    sib.slideUp();
    $(this).removeClass("active");
  } else {
    sib.slideDown();
    $(this).addClass("active");
  }
});
