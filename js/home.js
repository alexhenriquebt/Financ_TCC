const ctx = document.getElementById("bar_chart");

new Chart(ctx, {
  type: "bar",
  data: {
    labels: [
      "Jan",
      "Fev",
      "Mar",
      "Abr",
      "Mai",
      "Jun",
      "Jul",
      "Ago",
      "Set",
      "Out",
      "Nov",
      "Dez",
    ],
    datasets: [
      {
        label: "Evolução pratimonial",
        data: [3000000000, 5000000000, 2000000000, 3000000000, 400000000, 500000000, 600000000, 1000000000, 1550000000, 2000000000],
        backgroundColor: "rgb(253, 136, 59)",
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});