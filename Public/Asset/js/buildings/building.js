function deleteBuilding(id){
    axios.delete(`/building/delete/${id}`)
        .then(response => {
            if (response.data.success){
                window.location.href = response.data.redirect_url;
            } else {
                alert(response.data.message);
            }
        })
        .catch(error => {
            console.log(error);
        })
}