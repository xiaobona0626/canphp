var addressInit = function(_cmbProvince, _cmbCity, _cmbArea, defaultProvince, defaultCity, defaultArea)
{
    var cmbProvince = document.getElementById(_cmbProvince);
    var cmbCity = document.getElementById(_cmbCity);
    //var cmbArea = document.getElementById(_cmbArea);

    function cmbSelect(cmb, str)
    {
        for(var i=0; i<cmb.options.length; i++)
        {
            if(cmb.options[i].value == str)
            {
                cmb.selectedIndex = i;
                return;
            }
        }
    }
    function cmbAddOption(cmb, str, obj)
    {
        var option = document.createElement("option");
        cmb.options.add(option);
        option.innerHTML = str;
        option.value = str;
        option.obj = obj;
    }

    function changeCity()
    {
        cmbArea.options.length = 0;
        if(cmbCity.selectedIndex == -1)return;
        var item = cmbCity.options[cmbCity.selectedIndex].obj;
        for(var i=0; i<item.areaList.length; i++)
        {
            cmbAddOption(cmbArea, item.areaList[i], null);
        }
        cmbSelect(cmbArea, defaultArea);
    }
    function changeProvince()
    {
        cmbCity.options.length = 0;
        cmbCity.onchange = null;
        if(cmbProvince.selectedIndex == -1)return;
        var item = cmbProvince.options[cmbProvince.selectedIndex].obj;
        for(var i=0; i<item.cityList.length; i++)
        {
            cmbAddOption(cmbCity, item.cityList[i], null);
        }
        cmbSelect(cmbCity, defaultCity);
        //changeCity();
        //cmbCity.onchange = changeCity;
    }

    for(var i=0; i<provinceList.length; i++)
    {
        cmbAddOption(cmbProvince, provinceList[i].name, provinceList[i]);
    }
    cmbSelect(cmbProvince, defaultProvince);
    changeProvince();
    cmbProvince.onchange = changeProvince;
}

var provinceList = [
    {name:'上海',cityList:['黄浦区','卢湾区','徐汇区','长宁区','静安区','普陀区','闸北区','虹口区','杨浦区','闵行区','宝山区','嘉定区','浦东新区','金山区','松江区','青浦区','南汇区','奉贤区','崇明县']},
    {name:'广州',cityList:['市辖区','东山区','荔湾区','越秀区','海珠区','天河区','芳村区','白云区','黄埔区','番禺区','花都区','增城市','从化市']},
    {name:'青岛',cityList:['市辖区','市南区','市北区','四方区','黄岛区','崂山区','李沧区','城阳区','胶州市','即墨市','平度市','胶南市','莱西市']},
    {name:'南京',cityList:['市辖区','玄武区','白下区','秦淮区','建邺区','鼓楼区','下关区','浦口区','栖霞区','雨花台区','江宁区','六合区','溧水县','高淳县']},
    {name:'温州',cityList:['市辖区','鹿城区','龙湾区','瓯海区','洞头县','永嘉县','平阳县','苍南县','文成县','泰顺县','瑞安市','乐清市']},
	{name:'赣州', cityList:['市辖区','章贡区','赣县','信丰县','大余县','上犹县','崇义县','安远县','龙南县','定南县','全南县','宁都县','于都县','兴国县','会昌县','寻乌县','石城县','瑞金市','南康市']},
	{name:'宣城', cityList:['市辖区','宣州区','郎溪县','广德县','泾　县','绩溪县','旌德县','宁国市']}
];