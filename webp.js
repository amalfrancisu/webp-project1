
function webpHtmlForCourse(course, categoryName)
{
  let htmlCode = "";

  htmlCode +=        '<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">';
  htmlCode +=          '<div class="course-item">';
  htmlCode +=            '<img src=' + course["courseImg"] + ' class="img-fluid" alt="...">';
  htmlCode +=            '<div class="course-content">';
  htmlCode +=              '<div class="d-flex justify-content-between align-items-center mb-3">';
  htmlCode +=                '<h4>' + course["enrolled"] + '</h4>';
  htmlCode +=                '<p class="price">' + course["courseDuration"] + '</p>';
  htmlCode +=              '</div>';
  htmlCode +=              '<h3><a href=' + course["courseLink"] + '>' + course["courseName"] + '</a></h3>';
  htmlCode +=              '<p>' + course["courseDescription"];
  htmlCode +=              '<i> <br> <a href = ' + course["studyMaterials"] + '>' + "Study&nbsp;Materials" + '</a> </i> </p>';
  htmlCode +=              '<div class="trainer d-flex justify-content-between align-items-center">';
  htmlCode +=                '<div class="trainer-profile d-flex align-items-center">';
  htmlCode +=                  '<img src=' + course["trainerImg"] + ' class="img-fluid" alt="">';
  htmlCode +=                  '<span>' + course["trainerName"] + '</span>';
  htmlCode +=                '</div>';
  htmlCode +=                '<div class="trainer-rank d-flex align-items-center">';
  htmlCode +=                  '<i class="bx bx-user"></i>&nbsp;' + course["users"];
  htmlCode +=                  '&nbsp;&nbsp;';
  htmlCode +=                  '<i class="bx bx-heart"></i>&nbsp;' + course["hearts"];
  htmlCode +=                '</div>';
  htmlCode +=              '</div>';
  htmlCode +=            '</div>';
  htmlCode +=          '</div>';
  htmlCode +=        '</div>';

  return htmlCode;

}

//categoryId is "1" for HTML, courseType means "Full Course"...
function webpHtmlForRow(categoryId, courseType) {
  let availableCourses = webpCourses[categoryId][courseType];
  let count = availableCourses["count"];
  let htmlCode = "";
  for(let i=1; i<=count; i++) {
    let courseId = i.toString();
    htmlCode += webpHtmlForCourse(availableCourses[courseId], webpCourses[categoryId]["categoryName"]);
  }
  return htmlCode;
}


function webpFillCoursePage(includeFullCourses, includeShortCourses, includeMiniCourses) {

      let queryString = decodeURIComponent(window.location.search);
      queryString = queryString.substring(1);
      let queries = queryString.split("&");
      let webpCategoryId = queries[0].split("=")[1];


      let webpCategoryName = '<h2 id="webpCategoryNameHeading">' + webpCourses[webpCategoryId]["categoryName"] + "</h2>";
      let webpFullCourses = webpHtmlForRow(webpCategoryId, "Full Courses");
      let webpShortCourses = webpHtmlForRow(webpCategoryId, "Short Courses");
      let webpMiniCourses = webpHtmlForRow(webpCategoryId, "Mini Courses");

      let htmlForRowDeclaration = '<div class="row" data-aos="zoom-in" data-aos-delay="100">';
      webpFullCourses = '<div class="course-content"> <h2> Full Courses </h2> </div>' + htmlForRowDeclaration + webpFullCourses + '</div>';
      webpShortCourses = '<div class="course-content"> <h2> <br><br> Short Courses </h2> </div>' + htmlForRowDeclaration + webpShortCourses + '</div>';
      webpMiniCourses = '<div class="course-content"> <h2> <br><br> Mini Courses </h2> </div>' + htmlForRowDeclaration + webpMiniCourses + '</div>';

      if(! document.getElementById("webpCategoryNameHeading")) {
      document.getElementById("categoryNameAfterThis").insertAdjacentHTML("afterend", webpCategoryName);
      }
      if(includeFullCourses) {
      document.getElementById("fullCoursesAfterThis").insertAdjacentHTML("afterend", webpFullCourses);
      }
      if(includeShortCourses) {
      document.getElementById("shortCoursesAfterThis").insertAdjacentHTML("afterend", webpShortCourses);
      }
      if(includeMiniCourses) {
      document.getElementById("miniCoursesAfterThis").insertAdjacentHTML("afterend", webpMiniCourses);
      }

    }

function webpRedirectToCoursePage(categoryId) {
    let textField = document.getElementById("formFieldForCategoryId").value = categoryId;
    document.getElementById("formForCategoryId").submit();
}

function webpApplyFilter() {
    let generatedHtmlCode = document.getElementById("webpGeneratedHtmlCode");
    while (generatedHtmlCode.firstChild) {
          generatedHtmlCode.removeChild(generatedHtmlCode.lastChild);
    }
    let recoveredNodesHtml = '<div id="fullCoursesAfterThis"></div>' + '<div id="shortCoursesAfterThis"></div>' + '<div id="miniCoursesAfterThis"></div>';

    document.getElementById("webpGeneratedHtmlCode").insertAdjacentHTML("beforeend", recoveredNodesHtml);

    let includeFullCourses = document.getElementById("webpCheckboxForFullCourses").checked;
    let includeShortCourses = document.getElementById("webpCheckboxForShortCourses").checked;
    let includeMiniCourses = document.getElementById("webpCheckboxForMiniCourses").checked;
    webpFillCoursePage(includeFullCourses, includeShortCourses, includeMiniCourses);
}
