const toTop = (() => {
    let button = document.getElementById("toTop");
    window.onscroll = () => {
      button.classList[
          (document.documentElement.scrollTop > 200) ? "add" : "remove"
        ]("is-visible")
    }
    button.onclick = () => {
      window.scrollTo({
        top:0, behavior:"smooth"
      })
    }
  })();