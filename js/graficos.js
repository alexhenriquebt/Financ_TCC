function graPizza(params) {
    
}

function graDoughnut(params) {
    
}

function (titleGraph, valueJan, valueFev, valueMar, valueAbr, valueMai, graBarrasvalueJun, valueJul, valueAgo, valueSet, valueOut, valueNov, valueDez) {
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
        label: titleGraph,
        data: [valueJan, valueFev, valueMar, valueAbr, valueMai, valueJun, valueJul, valueAgo, valueSet, valueOut, valueNov, valueDez],
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
}