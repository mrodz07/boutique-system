var source = document.getElementById("color");

function displayWhenSelected = (source, value, target) => {
    var selectedIndex = source.selectedIndex;
    var isSelected = source[selectedIndex].value === value;
    target.classList[isSelected
        ? "add"
        : "remove"
    ]("show");
};

source.addEventListener("change", (evt) =>
    displayWhenSelected(source, "loc5", target)
);
