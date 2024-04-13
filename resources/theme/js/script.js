window.onload = function() { 
    if (document.getElementById("liveToast")) { // Check if the toast element exists
      const toastLiveExample = document.getElementById("liveToast");
      const toast = new bootstrap.Toast(toastLiveExample);
      toast.show();
    }
  };
  