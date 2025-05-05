function changetab(tab){

    document.getElementById('todastab').style.display = tab === 'todas' ? 'block' : 'none';
    document.getElementById('atuaisstab').style.display = tab === 'atuais' ? 'block' : 'none';
    document.getElementById('alertasstab').style.display = tab === 'alertas' ? 'block' : 'none';

}