
// Sidebar Toggle
document
  .getElementById("sidebarToggleTop")
  .addEventListener("click", function () {
    document.querySelector(".sidebar").classList.toggle("toggled")
    document.querySelector(".main-content").classList.toggle("toggled")
  })

// Complaints Chart
var ctx = document.getElementById("complaintsChart").getContext("2d")
var complaintsChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
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
      },
    },
  },
})

// Simple DataTable-like functionality
document.addEventListener("DOMContentLoaded", function () {
  const table = document.getElementById("recentComplaints")
  const rows = table.querySelectorAll("tbody tr")
  const rowsPerPage = 5
  let currentPage = 1

  function showPage(page) {
    const start = (page - 1) * rowsPerPage
    const end = start + rowsPerPage

    rows.forEach((row, index) => {
      if (index >= start && index < end) {
        row.style.display = ""
      } else {
        row.style.display = "none"
      }
    })
  }

  // Initial page display
  showPage(currentPage)

  // You could add pagination controls here if needed
  // For a complete DataTable replacement, you might want to use a lightweight library
  // like List.js or create a more comprehensive solution
})
