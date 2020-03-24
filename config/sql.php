<?php

abstract class SQL{
    const retrieve_event_manager ="SELECT manager FROM MANAGER_EVENT WHERE event = :id";
    const retrieve_all_venues = "SELECT * FROM VENUE";
    const retrieve_all_roles = "SELECT * FROM ROLE";
    const retrieve_all_users ="SELECT * FROM ATTENDEE";
    const retrieve_all_events ="SELECT * FROM EVENT";
    const retrieve_all_sessions = "SELECT * FROM SESSION";
    const retrieve_all_registrations = "SELECT event.name,
                                                attendee_event.event,
                                                attendee_event.attendee,
                                                attendee_session.session,
                                                attendee_event.paid
                                        FROM attendee_event
                                        INNER JOIN event on event.idevent = attendee_event.event
                                        INNER JOIN
                                        attendee_session on attendee_session.attendee = attendee_event.attendee";

    const create_venue = "INSERT INTO VENUE(name,capacity)VALUES(:name,:capacity)";
    const create_user = "INSERT INTO ATTENDEE(name,password,role)VALUES(:name,:password,:role)";
    const create_event = "INSERT INTO EVENT(name,
                                      datestart,
                                      dateend,
                                      numberallowed,
                                      venue)
                                      VALUES(:name,
                                      :datestart,
                                      :dateend,
                                      :numberallowed,
                                      :venue)";
    const create_event_manager = "INSERT INTO MANAGER_EVENT(event,manager)VALUES(:event,:manager)";
    const create_session = "INSERT INTO SESSION(name,
                            numberallowed,
                            event,
                            startdate,
                            enddate)VALUES(:name,
                            :numberallowed,:event,:startdate,:enddate);";
    const create_attendee_event = "INSERT INTO ATTENDEE_EVENT(event,attendee,paid)VALUES(:event,:attendee,:paid);";
    const create_attendee_session = "INSERT INTO ATTENDEE_SESSION(session,attendee)VALUES(:session,:attendee);";


    const delete_user = "DELETE FROM ATTENDEE WHERE idattendee = :id";
    const delete_venue = "DELETE FROM VENUE WHERE idvenue = :id";
    const delete_event_sessions = "DELETE FROM SESSION WHERE event = :id;";
    const delete_event_attendees = "DELETE FROM ATTENDEE_EVENT WHERE event = :id;";
    const delete_event_management = "DELETE FROM MANAGER_EVENT WHERE event = :id;";
    const delete_event = "DELETE FROM EVENT WHERE idevent = :id;";
    const delete_attendee_event = "DELETE FROM ATTENDEE_EVENT WHERE attendee = :attendee AND event = :event";
    const delete_attendee_session = "DELETE FROM ATTENDEE_SESSION WHERE attendee = :attendee AND session = :session";
    const delete_session = "DELETE FROM SESSION WHERE idsession = :id";
    const delete_all_attendee_sessions = "DELETE FROM ATTENDEE_SESSION WHERE session = :id";
    const delete_attendee_session_begin = "DELETE FROM ATTENDEE_SESSION WHERE ";

    const update_event_venue = "UPDATE EVENT SET venue = :venue WHERE venue = :id;";
    const update_venue ="UPDATE VENUE SET name = :name, capacity = :capacity WHERE idvenue = :id;";
    const update_user = "UPDATE ATTENDEE SET ";
    const update_attendee_session = "UPDATE ATTENDEE_SESSION SET 
                                        session = :session 
                                        WHERE attendee = :attendee AND session =:id";
    const update_attendee_event = "UPDATE ATTENDEE_EVENT SET 
                                        paid = :paid
                                        WHERE attendee = :attendee AND event =:id";
    const update_session = "UPDATE SESSION SET name = :name,
                            numberallowed = :numberallowed,
                            startdate =:startdate,
                            enddate =:enddate
                            WHERE idsession = :id";
}
