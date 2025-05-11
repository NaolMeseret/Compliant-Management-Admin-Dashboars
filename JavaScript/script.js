// Enhanced script.js with additional functionality
document.addEventListener("DOMContentLoaded", function () {
  // Check if chart element exists
  const chartElement = document.getElementById("complaintsChart");

  if (chartElement) {
    // Ensure canvas is visible and has size
    if (chartElement.offsetWidth > 0 && chartElement.offsetHeight > 0) {
      initializeComplaintsChart();
    } else {
      // If canvas is hidden, initialize when it becomes visible
      const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
          initializeComplaintsChart();
          observer.disconnect();
        }
      });
      observer.observe(chartElement);
    }
  }
});

function initializeComplaintsChart() {
  try {
    const ctx = document.getElementById("complaintsChart").getContext("2d");

    // Destroy previous chart instance if exists
    if (window.complaintsChart instanceof Chart) {
      window.complaintsChart.destroy();
    }

    window.complaintsChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
          {
            label: "Submitted",
            backgroundColor: "rgba(78, 115, 223, 0.5)",
            borderColor: "rgba(78, 115, 223, 1)",
            borderWidth: 1,
            data: [65, 59, 80, 81, 56, 55, 40, 72, 88, 94, 105, 120],
          },
          {
            label: "Resolved",
            backgroundColor: "rgba(28, 200, 138, 0.5)",
            borderColor: "rgba(28, 200, 138, 1)",
            borderWidth: 1,
            data: [40, 35, 45, 50, 42, 38, 30, 45, 60, 70, 80, 95],
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
          },
        },
        // Add this to handle container resizing
        onResize: function (chart, size) {
          chart.resize();
        }
      }
    });

    // Handle window resize
    window.addEventListener('resize', function () {
      if (window.complaintsChart) {
        window.complaintsChart.resize();
      }
    });

  } catch (error) {
    console.error("Error initializing chart:", error);
  }
}
// Document Ready Handler
document.addEventListener("DOMContentLoaded", function () {
  // 1. Sidebar Toggle Functionality
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebarToggleTop = document.getElementById("sidebarToggleTop");

  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function () {
      toggleSidebar();
    });
  }

  if (sidebarToggleTop) {
    sidebarToggleTop.addEventListener("click", function () {
      toggleSidebar();
    });
  }

  // 2. Initialize DataTables with more options
  initDataTables();

  // 3. Initialize Charts if they exist on the page
  initCharts();

  // 4. Notification Bell Animation
  setupNotificationBell();

  // 5. Logout Modal Confirmation
  setupLogoutModal();
});

// ==================== FUNCTIONS ====================

function toggleSidebar() {
  const sidebar = document.querySelector(".sidebar");
  const mainContent = document.querySelector(".main-content");

  if (sidebar && mainContent) {
    sidebar.classList.toggle("toggled");
    mainContent.classList.toggle("toggled");

    // Save state in localStorage
    const isToggled = sidebar.classList.contains("toggled");
    localStorage.setItem('sidebarToggled', isToggled);
  }
}

function initDataTables() {
  // Recent Complaints Table
  if (document.getElementById("recentComplaints")) {
    $('#recentComplaints').DataTable({
      pageLength: 5,
      lengthChange: false,
      searching: false,
      info: false,
      responsive: true,
      language: {
        emptyTable: "No complaints found",
        paginate: {
          previous: "<i class='bi bi-chevron-left'></i>",
          next: "<i class='bi bi-chevron-right'></i>"
        }
      }
    });
  }

  // Initialize other DataTables if they exist
  if (document.getElementById("dataTable")) {
    $('#dataTable').DataTable({
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search...",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        paginate: {
          previous: "<i class='bi bi-chevron-left'></i>",
          next: "<i class='bi bi-chevron-right'></i>"
        }
      }
    });
  }
}

function initCharts() {
  // Complaints Chart
  if (document.getElementById("complaintsChart")) {
    const ctx = document.getElementById("complaintsChart").getContext("2d");
    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
          {
            label: "Submitted",
            backgroundColor: "rgba(78, 115, 223, 0.5)",
            borderColor: "rgba(78, 115, 223, 1)",
            borderWidth: 1,
            data: [65, 59, 80, 81, 56, 55, 40, 72, 88, 94, 105, 120],
          },
          {
            label: "Resolved",
            backgroundColor: "rgba(28, 200, 138, 0.5)",
            borderColor: "rgba(28, 200, 138, 1)",
            borderWidth: 1,
            data: [40, 35, 45, 50, 42, 38, 30, 45, 60, 70, 80, 95],
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return value.toLocaleString();
              }
            }
          }
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: function (context) {
                return `${context.dataset.label}: ${context.raw.toLocaleString()}`;
              }
            }
          }
        }
      }
    });
  }

  // Add other chart initializations as needed
}

function setupNotificationBell() {
  const notificationBell = document.querySelector(".bi-bell");

  if (notificationBell) {
    // Check if there are new notifications
    const hasNewNotifications = true; // This would come from your PHP backend

    if (hasNewNotifications) {
      notificationBell.classList.add("new-notifications");

      // Add pulse animation
      notificationBell.style.animation = "pulse 1.5s infinite";

      // Click handler to mark as read
      notificationBell.closest(".nav-link").addEventListener("click", function () {
        notificationBell.classList.remove("new-notifications");
        notificationBell.style.animation = "";
        // Here you would typically make an AJAX call to mark notifications as read
      });
    }
  }
}

function setupLogoutModal() {
  const logoutModal = document.getElementById("logoutModal");

  if (logoutModal) {
    // Add confirmation handler
    logoutModal.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      // You could add additional confirmation logic here
    });
  }
}

// ==================== UTILITY FUNCTIONS ====================

// Helper function for AJAX requests
function makeRequest(url, method = 'GET', data = null) {
  return fetch(url, {
    method: method,
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: data ? JSON.stringify(data) : null
  })
    .then(response => response.json());
}

// Initialize tooltips
if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}
// Update copyright year automatically
document.getElementById('current-year').textContent = new Date().getFullYear();

// Add animation to footer links
document.querySelectorAll('.footer-links a').forEach(link => {
  link.addEventListener('mouseenter', () => {
    link.style.transform = 'translateX(5px)';
  });
  link.addEventListener('mouseleave', () => {
    link.style.transform = 'translateX(0)';
  });
});