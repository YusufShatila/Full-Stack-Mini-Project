const pages ={};

pages.base_url = "http://localhost/Full_Stack_Mini_Project";

pages.print_message = (message) =>{
    console.log(message);
}

pages.getAPI = async (url) => {
    try {
        const response = await fetch(url);
        console.log(response);
        if (!response.ok) {
            const errorText = await response.text();
            throw new Error("Network response was not ok: " + errorText);
        }

        return await response;
    } catch (error) {
        pages.print_message("Error from GET API: " + error);
    }
}


pages.page_signin = async () => {
    const signin = pages.base_url + "signin.php";
    const response = await pages.getAPI(signin);
}

pages.loadFor = (page) => {
    console.log("pages.page_" + page + "();")
}

