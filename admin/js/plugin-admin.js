/*
* No need to wrap in document.ready or DOMContentLoaded
* since the script is enqueued in the footer and runs after the DOM is fully loaded
*/

// jQuery codes wrapped in an IIFE
(function ($) {
  'use strict';

  $(() => {
    $('.color-picker').wpColorPicker();
  });

}(jQuery));


// Vanilla JS codes wrapped in an IIFE
(function () {
  'use strict';

  const tabs = document.querySelectorAll('.nav-tab');

  tabs.forEach((tab) => {
    tab.addEventListener('click', (e) => {
      e.preventDefault();

      // Add active class to clicked tab
      tab.classList.add('active');

      // Find current active tab and hide its content
      const currentActiveTab = document.querySelector('.nav-tab.active');
      const currentVisibleContent = document.querySelector('.tab-content.active');

      // Remove active classes if they exist
      if (currentActiveTab) {
        currentActiveTab.classList.remove('active');
      }

      if (currentVisibleContent) {
        currentVisibleContent.classList.remove('active');
      }

      // Get target ID from clicked tab
      const targetId = tab.getAttribute('href').substring(1); // Remove the '#'
      const targetContent = document.getElementById(targetId);

      // Show target content if exists
      if (targetContent) {
        targetContent.classList.add('active');
      }
    });
  });
}());
