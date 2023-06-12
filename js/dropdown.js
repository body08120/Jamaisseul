const teams = document.querySelectorAll('.team')
console.log(teams)

teams.forEach(team => {
    let dropdownArrow = team.querySelector('.fa-chevron-down')
    if(dropdownArrow !== null){
        const dropdownContent = team.querySelector('.dropdown-content') 
        dropdownArrow.addEventListener('click', e => {
            
        })
    }
})

function hideAllDropdowns(){
    const dropdowns = document.querySelectorAll('.dropdown-content')
    dropdowns.forEach(dropdown => dropdown.style.display = "none")
}