function changetab(tab){ 
    document.getElementById('todastab').style.display = tab === 'todas' ? 'block' : 'none';
    document.getElementById('todascontent').style.display = tab === 'todas' ? 'block' : 'none';
    document.getElementById('atuaisstab').style.display = tab === 'atuais' ? 'block' : 'none';
    document.getElementById('atuaiscontent').style.display = tab === 'atuais' ? 'block' : 'none';
    document.getElementById('alertasstab').style.display = tab === 'alertas' ? 'block' : 'none';
    document.getElementById('alertascnotent').style.display = tab === 'alertas' ? 'block' : 'none';

    localStorage.setItem('selectedTab', tab);
}

document.addEventListener('DOMContentLoaded', () => {
    const savedTab = localStorage.getItem('selectedTab') || 'atuais';
    changetab(savedTab);
});