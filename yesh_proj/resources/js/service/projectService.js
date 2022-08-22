var token = document.getElementsByName("_token")[0].value;

export var projects = [];
export var projectTemp = {};


export function testeService(data) {
    projectTemp.id = 1;
    data(projectTemp);
}


export function getProject(id, calbackFunction) {
    let url = `/employee/get/project/${id}`;
    fetch(url)
        .then((resp) => resp.json())
        .then(function(retorno) {
            calbackFunction(retorno);
        })
        .catch(function(error) {
            console.log(error);
        });
}

export function getList(calbackFunction) {
    let url = '/employee/list/projects';
    fetch(url)
        .then((resp) => resp.json())
        .then(function(retorno) {
            calbackFunction(retorno)
        })
        .catch(function(error) {
            console.log(error);
        });
}

export function getListStatusProjects(calbackFunction, id) {
    let url = `/employee/list/statusprojects/${id}`;
    fetch(url)
        .then((resp) => resp.json())
        .then(function(retorno) {
            calbackFunction(retorno)
        })
        .catch(function(error) {
            console.log(error);
        });
}

export function getListProjectEmployees(calbackFunction, id) {
    let url = `/employee/list/projectEmployees/${id}`;
    fetch(url)
        .then((resp) => resp.json())
        .then(function(retorno) {
            calbackFunction(retorno)
        })
        .catch(function(error) {
            console.log(error);
        });
}


export function updateProject(project, calbackFunction) {
    console.log(`/employee/projects/${project.id}`);
    let url = `/employee/projects/${project.id}`;
    let data = {};
    data.project = project;
    data._method = "PATCH";
    data.token = token;
    fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: new Headers({
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": token
            })
        })
        .then((resp) => resp.json())
        .then(function(resp) {
            calbackFunction(resp)
        })
        .catch(function(error) {
            console.log(error);
        });
}



export function updateStatusProject(stausProject, calbackFunction) {
    console.log(`/employee/statusproject/`);
    let url = `/employee/statusproject/`;
    console.log(stausProject);
    let data = {};
    data.company_id = stausProject.company_id;
    data.description = stausProject.description;
    data.employee_id = stausProject.employee_id;
    data.project_id = stausProject.project_id;
    data.status = stausProject.status;
    data._method = "POST";
    data.token = token;
    fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: new Headers({
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": token
            })
        })
        .then((resp) => resp.json())
        .then(function(resp) {
            calbackFunction(resp)
        })
        .catch(function(error) {
            console.log(error);
        });
}