import {useNavigate} from 'react-router-dom'
import React, { useEffect, useState } from 'react'
import BloodImg from '../assets/img/svg.png'
import HeartLogo from '../assets/icons/activity-heart.svg'
import { Socket } from '..'

function Auth() {
    const [role,setRole] = useState('')
    const [roled,setRoled] = useState(false)
    const [signedUp, setSignedUp] = useState()
    const [auth, setAuth] = useState('')
    const [login, setLogin] = useState('')
    const [password, setPassword] = useState('')
    const [confirmPassword, setConfirmPassword] = useState('')
    const [firstName, setFirstName] = useState('')
    const [secondName, setSecondName] = useState('')
    const [address, setAddress] = useState('')
    const [date, setDate] = useState('')
    const [email, setEmail] = useState('')
    const [phone, setPhone] = useState('')
    const [bloodType, setBloodType] = useState('A')
    const [rhesus,setRhesus] = useState('%2B')
    const [diseases, setDiseases] = useState('')
    const [doctorName, setDoctorName] = useState('')
    const [doctorID, setDoctorID] = useState('')
    const [hospitals, setHospitals] = useState([])
    const [hospital, setHospital] = useState()
    const [doctors, setDoctors] = useState([])
    const [doctor, setDoctor] = useState()
    const navigate = useNavigate()

    useEffect(()=> {
        Socket.request("GET","hospital","showAll","").then(data => {setHospitals(data.data);setHospital(data.data[0].guid)})
    },[])

    useEffect(() => {
        setTimeout(() => {
            Socket.request("GET","doctor","index","").then(data => {setDoctors(data.data);setDoctor(data.data[0].guid)})
        },1000)
    },[])

    const HandleLogin = () => {
        if(phone && password){
            Socket.request("POST",role,"login",`?phone=${phone}&password=${password}`)
            .then(data => localStorage.setItem("user",JSON.stringify(data)))
            .then(() => navigate(`/main/?page=home&role=${role}`))
            .catch(() => {alert('Wrong credentials')})
        }
    }

    const HandlePassword = (password) => {
        setPassword(password)
    }

    const HandleConfirmPassword = (password) => {
        setConfirmPassword(password)
    }

    const HandleForm = () => {
        if(firstName && secondName && date && phone && email && address && password && confirmPassword){
            if(password === confirmPassword){
                setSignedUp(true)
            }
        }
    }

    const HandleSignUp = () => {
        switch(role){
            case "donor":
                if(bloodType && rhesus && diseases){
                    Socket.request("POST",role,"register",`?name=${firstName}&surname=${secondName}&phone=${phone}&address=${address}&email=${email}&password=${password}&birth=${date}&blood_type=${bloodType}&blood_rh=${rhesus}&blood_disease=${diseases}`)
                    .then(data => localStorage.setItem("user",JSON.stringify(data)))
                    .then(() => {setAuth('login');setSignedUp(false)})
                    .catch(() => {console.log('zalupa')})
                }
                break;
            case "patient":
                if(doctor && bloodType && rhesus && diseases){
                    Socket.request("POST",role,"register",`?name=${firstName}&surname=${secondName}&phone=${phone}&address=${address}&email=${email}&password=${password}&birth=${date}&blood_type=${bloodType}&blood_rh=${rhesus}&blood_disease=${diseases}&doctor_guid=${doctor}`)
                    .then(data => localStorage.setItem("user",JSON.stringify(data)))
                    .then(() => {setAuth('login');setSignedUp(false)})
                }
                break;
            case "doctor":
                if(hospital){
                    Socket.request("POST",role,"register",`?name=${firstName}&surname=${secondName}&phone=${phone}&address=${address}&email=${email}&password=${password}&birth=${date}&hospital_guid=${hospital}`)
                    .then(data => localStorage.setItem("user",JSON.stringify(data)))
                    .then(() => {setAuth('login');setSignedUp(false)})
                }
                break;
            case "staff":
                if(hospital){
                    Socket.request("POST",role,"register",`?name=${firstName}&surname=${secondName}&phone=${phone}&address=${address}&email=${email}&password=${password}&birth=${date}&hospital_guid=${hospital}`)
                    .then(data => localStorage.setItem("user",JSON.stringify(data)))
                    .then(() => {setAuth('login');setSignedUp(false)})
                }
                break;
            
        }
    }

    const HandleFirstName = (name) => {
        setFirstName(name)
    }

    const HandleSecondName = (name) => {
        setSecondName(name)
    }

    const HandleDateOfBirth = (date) => {
        setDate(date)
    }

    const HandlePhone = (phone) => {
        setPhone(phone)
    }

    const HandleAddress = (address) => {
        setAddress(address)
    }

    const HandleEmail = (email) => {
        setEmail(email)
    }

    const HandleRole = (role) => {
        setRole(role)
    }

    const HandleRhesus = (type) => {
        setRhesus(type)
    }

    const HandleDiseases = (diseases) => {
        setDiseases(diseases)
    }

    const HandleBloodType = (type) => {
        setBloodType(type)
    }

    const HandleDoctorName = (name) => {
        setDoctorName(name)
    }

    const HandleDoctorID = (ID) => {
        setDoctorID(ID)
    }

    const HandleRoled = () => {
        if(role){
            setRoled(true)
        }
    }

  return (
    <div className="container">
      <img src={BloodImg} alt='bg' className='h-screen'/>

      <div className="container flex-col gap-[40px] m-auto max-w-[420px] py-[80px] flex-grow-[1]">
        <div className='container flex-col gap-[24px]'>
          <div className="container gap-[16px] mx-auto">
            <img src={HeartLogo} alt="logo"/>
            <h1>BloodCare</h1>
          </div>
          <h2 className='max-w-[400px] text-center'>Connecting donors and recipients, saving lives.</h2>
        </div>

        {
            !roled &&
            <>
                <div className='container flex-col gap-[16px]'>
                    <h3 className='text-grey-600'>Choose account type:</h3>
                    <div className="container gap-[8px] flex-wrap">
                        <div className={role === "donor" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleRole('donor')}>Donor</div>
                        <div className={role === "patient" ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleRole('patient')}>Patient</div>
                        <div className={role === "staff" ? "role-tab active" : "role-tab"} onClick={(e) => HandleRole('staff')}>H. Staff</div>
                        <div className={role === "doctor" ? "role-tab active" : "role-tab"} onClick={(e) => HandleRole('doctor')}>Doctor</div>
                        <div className={role === "admin" ? "role-tab active" : "role-tab"} onClick={(e) => HandleRole('admin')}>Admin</div>
                    </div>
                </div>

                <button onClick={(e) => HandleRoled()}>Continue</button>
            </>
        }

        {
            !auth && roled  && 
            <div className='container flex-col gap-[12px]'>
                <button onClick={() => setAuth('login')}>Log in</button>
                {role !== 'admin' && <button onClick={() => setAuth('signup')} className='secondary'>Sign up</button>}
            </div>
        }
        
        {
            (auth === 'login') && 
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4 className='input-header' >Phone*</h4>
                    <input type='text' onChange={(e) => HandlePhone(e.target.value)} value={phone}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Password*</h4>
                    <input type='password' onChange={(e) => HandlePassword(e.target.value)} value={password}/>
                </div>
                <button onClick={() => {HandleLogin()}}>Log in</button>
                {role !== 'Admin' &&
                <div className='flex mx-auto text-sm flex-col gap-[4px] leading-[48px]'>
                    <div className='flex gap-[6px]'>
                        <span className='text-grey-700'>Don’t have an account?</span>
                        <span className='text-red-600 underline cursor-pointer' onClick={() => setAuth('signup')}>Sign up</span>
                    </div>
                    <a className='text-red-600 underline cursor-pointer mx-auto' onClick={() => {navigate(`/reset/?role=${role}`)}}>Forgot password</a>
                    
                </div>
                }
            </div>
        }
        
        {
            (auth === 'signup') && !signedUp &&
            <div className='container flex-col gap-[16px]'>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>First Name*</h4>
                        <input type='text' onChange={(e) => HandleFirstName(e.target.value)}/>
                    </div>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Second Name*</h4>
                        <input type='text' onChange={(e) => HandleSecondName(e.target.value)}/>
                    </div>
                </div>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Date of birth*</h4>
                        <input type='date' onChange={(e) => HandleDateOfBirth(e.target.value)}/>
                    </div>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Phone number</h4>
                        <input type='text' onChange={(e) => HandlePhone(e.target.value)}/>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Email</h4>
                    <input type='text' onChange={(e) => HandleEmail(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Address</h4>
                    <input type='text' onChange={(e) => HandleAddress(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Password*</h4>
                    <input type='password' onChange={(e) => HandlePassword(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Confirm password*</h4>
                    <input type='password' onChange={(e) => HandleConfirmPassword(e.target.value)}/>
                </div>
                <button onClick={() => HandleForm()}>Sign up</button>
                <div className='flex mx-auto text-sm gap-[6px]'>
                    <span className='text-grey-700'>Already have an account?</span>
                    <span className='text-red-600 underline cursor-pointer' onClick={() => setAuth('login')}>Log in</span>
                </div>
            </div>
        }

        {
            signedUp && (role === 'donor') &&
            <div className='container flex-col gap-[16px]'>
                <div className='flex gap-[12px] justify-between'>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Blood type</h4>
                        <select onChange={(e) => HandleBloodType(e.target.value)} value={bloodType}>
                            <option value={"A"}>A</option>
                            <option value={"B"}>B</option>
                            <option value={"O"}>O</option>
                            <option value={"AB"}>AB</option>
                        </select>
                    </div>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Rhesus</h4>
                        <select onChange={(e) => HandleRhesus(e.target.value)} value={rhesus}>
                            <option value={"%2B"}>+</option>
                            <option value={"-"}>-</option>
                        </select>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Diseases</h4>
                    <input type='text' onChange={(e) => HandleDiseases(e.target.value)}/>
                </div>
                <button onClick={() => {HandleSignUp()}}>Continue</button>
            </div>
        }

        {
            signedUp && (role === 'patient') &&
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4 className='input-header'>Select your doctor</h4>
                    <select type='text' onChange={(e) => setDoctor(e.target.value)} value={doctor}>
                        {
                            doctors.map(doctor => <option key={doctor.guid} value={doctor.guid}>{`${doctor.name} ${doctor.surname}`}</option>)
                        }
                    </select>
                </div>
                <div className='flex gap-[12px] justify-between'>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Blood type</h4>
                        <select onChange={(e) => HandleBloodType(e.target.value)} value={bloodType}>
                            <option value={"A"}>A</option>
                            <option value={"B"}>B</option>
                            <option value={"O"}>O</option>
                            <option value={"AB"}>AB</option>
                        </select>
                    </div>
                    <div className='container flex-col max-w-[195px] flex-grow-[1]'>
                        <h4 className='input-header'>Rhesus</h4>
                        <select onChange={(e) => HandleRhesus(e.target.value)} value={rhesus}>
                            <option value={"%2B"}>+</option>
                            <option value={"-"}>-</option>
                        </select>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Diseases</h4>
                    <input type='text' onChange={(e) => HandleDiseases(e.target.value)}/>
                </div>
                <button onClick={() => {HandleSignUp()}}>Continue</button>
            </div>
        }

        {
            signedUp && (role === 'staff' || role === 'doctor') &&
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4 className='input-header'>Select your hospital</h4>
                    <select type='text' onChange={(e) => setHospital(e.target.value)} value={hospital}>
                        {
                            hospitals.map(hospital => <option key={hospital.guid} value={hospital.guid}>{hospital.name}</option>)
                        }
                    </select>
                </div>
                <button onClick={() => HandleSignUp()}>Continue</button>
            </div>
        }
      </div>
    </div>
  )
}

export default Auth