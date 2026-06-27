document.addEventListener("DOMContentLoaded", () => {
  // Слайдер (Главная страница)
  const slidesContainer = document.querySelector(".slides");
  if (slidesContainer) {
    const slides = document.querySelectorAll(".slide");
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");
    let currentIndex = 0;
    let interval;

    // Показать конкретный слайд
    function showSlide(index) {
      if (index < 0) currentIndex = slides.length - 1;
      else if (index >= slides.length) currentIndex = 0;
      else currentIndex = index;

      slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function nextSlide() {
      showSlide(currentIndex + 1);
    }
    function prevSlide() {
      showSlide(currentIndex - 1);
    }

    // Автоматическое переключение (5 секунд)
    function startSlider() {
      interval = setInterval(nextSlide, 5000);
    }

    nextBtn.addEventListener("click", () => {
      nextSlide();
      clearInterval(interval);
      startSlider();
    });
    prevBtn.addEventListener("click", () => {
      prevSlide();
      clearInterval(interval);
      startSlider();
    });

    startSlider();
  }
  const statusForms = document.querySelectorAll(".status-form");
  const modal = document.getElementById("confirm-modal");
  if (modal) {
    const confirmBtn = document.getElementById("confirm-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    let currentForm = null;

    statusForms.forEach((form) => {
      form.addEventListener("submit", function (e) {
        e.preventDefault(); // Останавливаем отправку
        currentForm = this; //
        modal.classList.add("show"); // Показываем окно
      });
    });

    // Закрыть окно
    cancelBtn.addEventListener("click", () => {
      modal.classList.remove("show");
      currentForm = null;
    });

    // Подтвердить отправку
    confirmBtn.addEventListener("click", () => {
      if (currentForm) {
        currentForm.submit();
      }
    });
  }
});
